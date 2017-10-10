<?php
/* @var $userModel \maxcom\user\models\User */
$form = \yii\widgets\ActiveForm::begin();?>
<?= $form->field($userModel,'email') ?>
<?= $form->field($userModel,'username') ?>
<?= $form->field($userModel,'password') ?>
<?= $form->field($userModel,'password_repeat') ?>
<?= \yii\bootstrap\Html::submitButton() ?>
<?php \yii\widgets\ActiveForm::end();?>
