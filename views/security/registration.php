<?php
$this->title = 'Registration';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?=$this->title?></h1>
<div class="row">
    <div class="col-md-6">
        <div class="well">
            Register on <?=Yii::$app->name?> will allow you to use more features :)
        </div>
        <?php
        /* @var $userModel \maxcom\user\models\User */
        $form = \yii\widgets\ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($formModel, 'email') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($formModel, 'username') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($formModel, 'password')->passwordInput() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($formModel, 'password_repeat')->passwordInput() ?>
            </div>
        </div>

        <?= \yii\bootstrap\Html::submitButton(
            'Register',
            ['class' => 'btn btn-success btn-block', 'style' => 'display:block;margin-bottom:5px;']
        ) ?>
        <?= \yii\helpers\Html::a('Sign in', ['/user/security/login']) ?>
        <?= \yii\helpers\Html::a('Reset', ['/user/security/reset-password'], ['class' => 'pull-right']) ?>
        <?php \yii\widgets\ActiveForm::end(); ?>
    </div>
</div>