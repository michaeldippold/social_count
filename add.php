<?php defined('C5_EXECUTE') or die(_("Access Denied.")) ?>
<div class="ccm-ui">
	<div class="alert-message block-message info">
		<?php echo t("Don't add anything to the form below.") ?>
	</div>

	<?php echo $form->label('content', t('Name')) ?>
	<?php echo $form->text('content') ?>
</div>