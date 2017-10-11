<?php
namespace maxcom\user\controllers;
use maxcom\user\models\LoginForm;
use maxcom\user\models\Profiles;
use maxcom\user\models\RegistrationForm;
use maxcom\user\models\User;
use yii\web\Controller;

class SecurityController extends Controller {

    public function actionRegistration()
    {
        $form = new RegistrationForm();
        if (\Yii::$app->request->isPost && $form->load(\Yii::$app->request->post())) {
             if($form->validate()){
                $user = new User();
                $user->attributes = $form->attributes;
                if($user->save()){
                    \Yii::$app->user->login($user);
                    \Yii::$app->session->setFlash('success','Добро пожаловать на '.\Yii::$app->name. ', '.$user->username);
                    $this->redirect('/');
                }
             }
        }

        return $this->render('registration',[
            'formModel' => $form,
        ]);

    }

    public function actionLogin(){
        if(\Yii::$app->user->isGuest){
            $model = new LoginForm();
            if(\Yii::$app->request->isPost && $model->load(\Yii::$app->request->post())){
                $user = $model->findByUsername($model->username); // пока так
                if(!empty($user)){
                    if($this->module->encrypting($model->password) == $user->password) {
                        \Yii::$app->user->login($user, $model->rememberMe ? $this->module->loginDuration : 0);
                        \Yii::$app->session->setFlash('success','Добро пожаловать, '. $user->username);
                        return $this->redirect('/');
                    } else {
                        $model->addError('username' ,'Логин или пароль не верен');
                        $model->addError('password' ,'Логин или пароль не верен');
                    }
                } else {
                    $model->addError('username' ,'Логин или пароль не верен');
                    $model->addError('password' ,'Логин или пароль не верен');

                }
            }
        } else {
            return $this->redirect('/');
        }

     return $this->render('login',[
        'userModel' => $model,
      ]);


    }

    public function actionLogout(){

    }

    public function actionResetPassword(){

    }

    public function actionChangePassword(){

    }
}