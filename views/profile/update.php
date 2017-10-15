<?php
$this->title = 'Profile area';
?>

<?php $form = \yii\widgets\ActiveForm::begin()?>

<div class="row">

    <div class="col-md-8">
        <div class="well">
            This is a profile area, where u can manage your user data
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
            <?=$form->field($user,'username') ?>
            <?=$form->field($user,'email') ?>

    </div>
    <div class="col-md-4">

        <?php foreach ($profile->profileFields as $field):?>
            <?php if($field->varname !== 'user_id'):?>
                <?=$form->field($profile, $field->varname)->textInput();?>
            <?php endif;?>
        <?php endforeach;?>

    </div>
    <div class="col-md-8">
        <?= \yii\helpers\Html::submitButton('Save',['class' => 'btn btn-success btn-block']);?>
    </div>
</div>
<?php \yii\widgets\ActiveForm::end();?>