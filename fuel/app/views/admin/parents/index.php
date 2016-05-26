
<?php foreach ($parents as $parent): ?>

	<h3><?php echo Html::anchor('admin/parents/view/'.$parent->user_id, $parent->password) ?></h3>
    <!-- <p><?php echo $parent->password ?></p> -->

<?php endforeach; ?>


