<?php
$title = 'Editar um usuario';
$this->headTitle($title);
?>
<h1><?php echo $this->escapeHtml($title); ?></h1>
<?php
$form = $this->form;
$form->setAttribute('action', $this->basePath('application/usuario/edit'));
$form->prepare();
?>
<div class="page-header">
<?php echo $this->form()->openTag($form); ?>
<?php echo $this->formHidden($form->get('id'));?>
    <div class="form-group">
    	<label for="nome" class="col-sm-2 control-label">Nome</label>
    	<div class="col-sm-3">
    		<?php echo $this->formRow($form->get('nome')); ?>
    	</div>
    </div>
    <div class="form-group">
    	<label for="email" class="col-sm-2 control-label">Email</label>
    	<div class="col-sm-3">
    		<?php echo $this->formRow($form->get('email')); ?>
    	</div>
    </div>
    <div class="form-group">
    	<label for="senha" class="col-sm-2 control-label">Senha</label>
    	<div class="col-sm-3">
    		<?php echo $this->formRow($form->get('senha')); ?>
    	</div>
    </div>
    <div class="form-group">
    	<label for="telefone" class="col-sm-2 control-label">Telefone</label>
    	<div class="col-sm-3">
    		<?php echo $this->formRow($form->get('telefone')); ?>
    	</div>
    </div>
    <div class="form-group">
    	<div class="col-sm-offset-2 col-sm-4">
    		<?php echo $this->formSubmit($form->get('submit')); ?>
    	</div>
    </div>
<?php echo $this->form()->closeTag();?>
</div>