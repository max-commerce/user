<?php

use \yii\widgets\ActiveForm;
use \yii\helpers\Html;

/*
* @author Vladimir Kurdyukov <numkms@gmail.com>
* @var $formModel \pantera\YiiYii2User\models\ResetPasswordForm;
*/

$this->title = 'Reset password';
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
                    For reset your password, please fill email below and check your mail.
                </p>
                <?php $form = ActiveForm::begin(); ?>
                
                <?= $form->field($formModel, 'email')->textInput(['placeholder' => 'E-mail'])->label(false) ?>

                <?= Html::submitButton('Reset', ['class' => 'btn btn-success btn-block']) ?>
                

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <div class="text-center">
            <?= Html::a('Sign Up', ['/user/security/login']) ?>
        </div>
    </div>
</div>
