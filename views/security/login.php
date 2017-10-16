<?php
$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Login</h1>
<div class="row">
    <div class="col-md-6">
        <?php
        /* @var $userModel \maxcom\user\models\User */
        $form = \yii\widgets\ActiveForm::begin(['options' => ['style' => 'margin-top:10px;']]); ?>
        <div class="well">
            Please login for use all features of <?= Yii::$app->name ?>
        </div>

        <?= $form->field($userModel, 'username')->textInput() ?>
        <?= $form->field($userModel, 'password')->passwordInput() ?>
        <?= $form->field($userModel, 'rememberMe')->checkbox() ?>

        <?= \yii\bootstrap\Html::submitButton('Login', ['class' => 'btn btn-success btn-block', 'style' => 'margin-bottom:5px;']) ?>
        <?= \yii\helpers\Html::a('Sign Up', ['/user/security/registration'], ['class' => '']) ?>
        <?= \yii\helpers\Html::a('Reset password', ['/user/security/reset-password'], ['class' => 'pull-right']) ?>
        <?php \yii\widgets\ActiveForm::end(); ?>
    </div>
</div>

