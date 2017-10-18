<?php

use \yii\widgets\ActiveForm;
use \yii\helpers\Html;

/*
 * @var $userModel \maxcom\user\models\LoginForm;
 */
$this->title = 'Login';
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
                    Please login for use all features of <?= Yii::$app->name ?>
                </p>
                <?php
                /* @var $userModel \maxcom\user\models\User */
                $form = ActiveForm::begin(); ?>

                <?= $form->field($userModel, 'username')->textInput() ?>
                <?= $form->field($userModel, 'password')->passwordInput() ?>
                <?= $form->field($userModel, 'rememberMe')->checkbox() ?>

                <?= Html::submitButton('Login', ['class' => 'btn btn-success btn-block']) ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <?= Html::a('Sign Up', ['/user/security/registration']) ?>
        <?= Html::a('Reset password', ['/user/security/reset-password'], ['class' => 'pull-right']) ?>
    </div>
</div>
