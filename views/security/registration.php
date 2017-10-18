<?php

use \yii\widgets\ActiveForm;
use \yii\helpers\Html;

/*
 * @author Vladimir Kurdyukov <numkms@gmail.com>
 * @var $userModel \maxcom\user\models\RegistrationForm;
 */
$this->title = 'Registration';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= $this->title ?>
            </div>
            <div class="panel-body">
                <p>
                    Register on <?= Yii::$app->name ?> will allow you to use more features :)
                </p>
                <?php
                /* @var $userModel \maxcom\user\models\User */
                $form = ActiveForm::begin(); ?>

                <?= $form->field($formModel, 'email') ?>
                <?= $form->field($formModel, 'username') ?>
                <?= $form->field($formModel, 'password')->passwordInput() ?>
                <?= $form->field($formModel, 'password_repeat')->passwordInput() ?>

                <?= Html::submitButton('Register', ['class' => 'btn btn-success btn-block']) ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <?= Html::a('Sign In', ['/user/security/login']) ?>
        <?= Html::a('Reset password', ['/user/security/reset-password'], ['class' => 'pull-right']) ?>
    </div>
</div>