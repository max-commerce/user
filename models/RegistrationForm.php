<?php

namespace maxcom\user\models;

use yii\base\Model;

class RegistrationForm extends Model
{
    public $username, $password, $password_repeat, $email;

    public function rules()
    {
        return [
            [['username'], 'string', 'min' => 4, 'max' => 20],
            [['password', 'password_repeat'], 'string', 'min' => 8,],
            [['email'], 'email'],
            [['username', 'password', 'password_repeat', 'email'], 'required'],
        ];
    }

    public function passEqualCheck()
    {
        if ($this->password == $this->password_repeat) {
            return true;
        } else {

        }
    }

    public function beforeValidate()
    {
        if ($this->username) {
            $user = \maxcom\user\models\User::findOne(['username' => $this->username]);
            if (!empty($user)) {
                $this->addError('username', 'This user is already exsist');
                return false;
            }
        }

        if ($this->email) {
            $user = \maxcom\user\models\User::findOne(['email' => $this->email]);
            if (!empty($user)) {
                $this->addError('email', 'This email is already exsist');
                return false;
            }
        }

        if ($this->password && $this->password_repeat) {
            $module = \Yii::$app->getModule('user');
            $this->password = $module->encrypting($this->password);
            $this->password_repeat = $module->encrypting($this->password_repeat);
        }

        if (!$this->passEqualCheck()) {
            $this->addError('password', 'Passwords not equal');
            return false;
        }

        return true;
    }
}
