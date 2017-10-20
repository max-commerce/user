<?php

namespace maxcom\user;

use yii\base\Module as BaseModule;

/*
 * @author Vladimir Kurdyukov <numkms@gmail.com>
 */
class Module extends BaseModule {

    public $loginDuration = 3600;

    public $hash = 'md5';

    public $emailRegistrationConfirm = false;

    public function init()
    {
        parent::init();
    }

    public function encrypting($string="") {

        if ($this->hash=="md5")
            return md5($string);
        if ($this->hash=="sha1")
            return sha1($string);
        else
            return hash($this->hash,$string);
    }
}
