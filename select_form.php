<?php
    defined('C5_EXECUTE') or die("Access Denied.");
    // Create formhelper
    $form = Loader::helper('form');
?>


	<!-- 
	Reference: 
	https://github.com/jordanlev/c5_custom_contact_form/blob/master/blocks/custom_contact_form/view.php 
	http://www.altinkonline.nl/tutorials/concrete5/make-a-concrete5-block/make-a-concrete5-block/
	http://www.concrete5.org/documentation/recorded-trainings/building-blocks/basic-block-development-four/

	 	"Will give you a checkbox in your add / edit form. This illustrates two things:

		a. The database column in your block (the <field> here) will be called the same thing in code. b. That data is passed to your add / edit interface by the controller.

		however, the block will not automatically pass $newcheckbox to the view.php. this would have to be done explicitly by doing $this->set('newcheckbox',$this->newcheckbox) in the controller's view() function.""

	-->

	<?php echo $form->checkbox('Twitter', 1) ?>
	<?php echo $form->label('Twitter', "Twitter"); ?>

	<br>

	<?php echo $form->checkbox('Pinterest', 1) ?>
	<?php echo $form->label('Pinterest', "Pinterest"); ?>

	<br>

	<?php echo $form->checkbox('Facebook', 1) ?>
	<?php echo $form->label('Facebook', "Facebook"); ?>

	<br>

	<?php echo $form->checkbox('Google', 1) ?>
	<?php echo $form->label('Google+', "Google+"); ?>
