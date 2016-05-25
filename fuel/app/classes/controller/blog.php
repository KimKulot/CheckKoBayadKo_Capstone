<?php 
		class Controller_Blog extends Controller_Base
	{
	    public function action_index()
	    {
	        $view = View::forge('blog/index');
	         
	        $view->parents = Model_Parent::find('all');
	         
	        $this->template->title = 'My Blog about Stuff';
	        $this->template->content = $view;
	    }
	}
 ?>