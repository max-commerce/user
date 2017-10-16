<?php

namespace maxcom\user\models;

use Yii;
use yii\web\IdentityInterface;


/**
 * This is the model class for table "shop_users".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $activkey
 * @property int $superuser
 * @property int $status
 * @property string $create_at
 * @property string $lastvisit_at
 *
 * @property ShopProfiles $shopProfiles
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $password_repeat;

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['activkey' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->activkey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->activkey === $authKey;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['superuser', 'status'], 'integer'],
            [['create_at', 'lastvisit_at'], 'safe'],
            [['username'], 'string', 'max' => 20],
            [['password', 'email', 'activkey'], 'string', 'max' => 128],
            [['username'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'activkey' => 'Activkey',
            'superuser' => 'Superuser',
            'status' => 'Status',
            'create_at' => 'Create At',
            'lastvisit_at' => 'Lastvisit At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profiles::className(), ['user_id' => 'id']);
    }
}
