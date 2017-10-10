<?php
/* @var $userModel \maxcom\user\models\User */
$form = \yii\widgets\ActiveForm::begin();?>
<?= $form->field($userModel,'username') ?>
<?= $form->field($userModel,'password') ?>
<?= \yii\bootstrap\Html::submitButton() ?>
<?php \yii\widgets\ActiveForm::end();?>
