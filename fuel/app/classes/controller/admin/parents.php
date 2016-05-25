<?php

	
class Controller_Admin_Parents extends Controller_Admin
{

	public function action_index()
	{
		$data['parents'] = Model_Parent::find('all');
		$this->template->title = "Parents";
		$this->template->content = View::forge('admin/parents/index', $data);

	}

	public function action_view($id = null)
	{
		$data['parent'] = Model_Parent::find($id);

		$this->template->title = "Parent";
		$this->template->content = View::forge('admin/parents/view', $data);

	}

	public function action_create()
	{
		$view  = View::forge('admin/parents/create');

		if (Input::method() == 'POST')
		{
			$val = Model_Parent::validate('create');

			if ($val->run())
			{
				$parent = Model_Parent::forge(array(
					'user_id' => Input::post('user_id'),
					'password' => Input::post('password'),
				));

				if ($parent and $parent->save())
				{
					Session::set_flash('success', e('Added parent #'.$parent->id.'.'));

					Response::redirect('admin/parents');
				}

				else
				{
					Session::set_flash('error', e('Could not save parent.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$view->set_global('users', Arr::assoc_to_keyval(Model_User::find('all'), 'id', 'username'));

		$this->template->title = "Parents";
		$this->template->content = $view;

	}

	public function action_edit($id = null)
	{
		$view = View::forge('admin/parents/edit');

		$parent = Model_Parent::find($id);
		$val = Model_Parent::validate('edit');

		if ($val->run())
		{
			$parent->user_id = Input::post('user_id');
			$parent->password = Input::post('password');

			if ($parent->save())
			{
				Session::set_flash('success', e('Updated parent #' . $id));

				Response::redirect('admin/parents');
			}

			else
			{
				Session::set_flash('error', e('Could not update parent #' . $id));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$parent->user_id = $val->validated('user_id');
				$parent->password = $val->validated('password');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('parent', $parent, false);
		}

		$view->set_global('users', Arr::assoc_to_keyval(Model_User::find('all'), 'id', 'username'));

		$this->template->title = "Parents";
		$this->template->content = $view;

	}

	public function action_delete($id = null)
	{
		if ($parent = Model_Parent::find($id))
		{
			$parent->delete();

			Session::set_flash('success', e('Deleted parent #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete parent #'.$id));
		}

		Response::redirect('admin/parents');

	}

}
