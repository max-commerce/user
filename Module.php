<?php

namespace pantera\YiiYii2User;

use yii\base\Module as BaseModule;

/*
 * @author Vladimir Kurdyukov <numkms@gmail.com>
 */
class Module extends BaseModule
{

    public $loginDuration = 3600;

    public $hash = 'md5';

    public $emailRegistrationConfirm = false;

    /**
     * @var string $userTableName
     * A variable for name of User table
     */
    public $userTableName = 'user';

    /**
     * @var string $userTableName
     * A variable for name of Profiles table
     */
    public $profilesTableName = 'profiles';

    /**
     * @var string $userTableName
     * A variable for name of ProfilesFields table
     */
    public $profilesFieldsTableName = 'profiles_fields';


    public function init()
    {
        parent::init();
    }

    public function encrypting($string = "")
    {

        if ($this->hash=="md5") {
            return md5($string);
        }
        if ($this->hash=="sha1") {
            return sha1($string);
        } else {
            return hash($this->hash, $string);
        }
    }
}
