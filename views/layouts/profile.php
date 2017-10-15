<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<h1><?=$this->title?></h1>
<div class="row">
    <div class="col-md-2">
        <ul class="nav nav-pills nav-stacked">
            <li <?=Yii::$app->controller->action->id == 'update' ? 'class="active"' : ''?>><a href="/user/profile">Profile</a></li>
            <li <?=Yii::$app->controller->action->id == 'change-password' ? 'class="active"' : ''?>><a href="/user/profile/change-password">Change Password</a></li>
        </ul>
    </div>
    <div class="col-md-10">
        <?=$content?>
    </div>
</div>
<?php $this->endContent()?>
