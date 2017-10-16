<?php
$this->title = 'Change password';?>
<div class="row">
    <div class="col-md-4">
        <?php $form = \yii\widgets\ActiveForm::begin();?>
            <?=$form->field($formModel,'old_password')->passwordInput() ?>
            <?=$form->field($formModel,'new_password')->passwordInput() ?>
            <?=$form->field($formModel,'new_password_repeat')->passwordInput()?>
            <?=\yii\helpers\Html::submitButton('Save',['class' => 'btn btn-success btn-block']);?>
        <?php \yii\widgets\ActiveForm::end()?>
    </div>
</div>