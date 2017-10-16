<?php
/*
* @author Vladimir Kurdyukov <numkms@gmail.com>
* @var $formModel \maxcom\user\models\ResetPasswordForm;
*/
?>
<div class="row">
    <div class="col-md-4">
        <div class="well">
            For reset your password, please fill email below and check your mail.
        </div>
        <?php $form = \yii\widgets\ActiveForm::begin(); ?>

        <?= $form->field($formModel, 'email')->textInput(['placeholder' => 'E-mail'])->label(false) ?>

        <?= \yii\bootstrap\Html::submitButton(
            'Reset',
            ['class' => 'btn btn-success btn-block', 'style' => 'display:block;margin-bottom:5px;']
        ) ?>

        <?= \yii\helpers\Html::a('Sign in', ['/user/security/login']) ?>
        <?= \yii\helpers\Html::a('Register', ['/user/security/registration'], ['class' => 'pull-right']) ?>

        <?php
        \yii\widgets\ActiveForm::end();
        ?>
    </div>
</div>
