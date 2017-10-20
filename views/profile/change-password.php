<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Change password';

?>
<div class="row">
    <div class="col-md-4">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($formModel, 'old_password')->passwordInput() ?>
        <?= $form->field($formModel, 'new_password')->passwordInput() ?>
        <?= $form->field($formModel, 'new_password_repeat')->passwordInput() ?>
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-block']); ?>
        <?php ActiveForm::end() ?>
    </div>
</div>