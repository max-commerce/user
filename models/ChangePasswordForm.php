<?php

namespace pantera\YiiYii2User\models;

use yii\base\Model;

class ChangePasswordForm extends Model
{

    public $old_password, $new_password, $new_password_repeat;

    public function rules()
    {
        return [
            [['old_password', 'new_password', 'new_password_repeat'], 'required'],
            [['old_password', 'new_password', 'new_password_repeat'], 'string', 'min' => 8]
        ];
    }

    public function validate($attributeNames = null, $clearErrors = true)
    {
        if (parent::validate($attributeNames, $clearErrors)) {
            if (\Yii::$app->getModule('user')->encrypting($this->old_password) !== \Yii::$app->user->identity->password) {
                $this->addError('old_password', 'Не верный старый пароль.');
                return false;
            }
            if ($this->new_password != $this->new_password_repeat) {
                $this->addError('new_password_repeat', 'Новый пароль не совпадает с подтверждением.');
                return false;
            }
            return true;
        } else {
            return false;
        }
    }

    public function save()
    {
        if ($this->validate()) {
            $user = \Yii::$app->user->identity;
            $user->password = \Yii::$app->getModule('user')->encrypting($this->new_password);
            return $user->save();
        }
    }
}
