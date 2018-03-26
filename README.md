# yii-yii2-user
This module is a port of Yii 1.1: yii-user extension http://www.yiiframework.com/extension/yii-user/ to Yii2 codebase. It depends on yii-user extension database scheme. You can use it in your Yii2 projects ported from Yii1.x

## Install

Either run

```
$ php composer.phar require pantera-digital/yii-yii2-user "@dev-master"
```

or add

```
"pantera-digital/yii-yii2-user": "@dev-master"
```

to the ```require``` section of your `composer.json` file.

#### Добавить в конфиг в секцию ```'components'```:
```
'user' => [
    'class' => 'pantera\YiiYii2User\components\User',
    'identityClass' => 'pantera\YiiYii2User\models\User',
    'enableAutoLogin' => true,
    'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
    'userTableName' => 'name of your user table',
    'profilesTableName' => 'name of your profiles table',
    'profilesFieldsTableName' => 'name of your profiles fields table'
],
```

#### Добавить в конфиг в секцию ```'modules'```:
```
'user' => [
    'emailRegistrationConfirm' => true,
    'class' => 'pantera\YiiYii2User\Module',
],
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.
