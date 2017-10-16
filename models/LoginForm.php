<?php
namespace maxcom\user\models;

use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['username', 'password'], 'string', 'max' => 255],
        ];
    }

    public function findByUsername($username)
    {
        return User::find()->where(['username' => $username])->one();
    }
}

?>