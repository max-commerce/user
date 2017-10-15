<?php
/*
 * @author Vladimir Kurdyukov <numkms@gmail.com>
 */
namespace maxcom\user\controllers;
use maxcom\user\models\ChangePasswordForm;
use maxcom\user\models\LoginForm;
use maxcom\user\models\Profiles;
use maxcom\user\models\RegistrationForm;
use maxcom\user\models\ResetPasswordForm;
use maxcom\user\models\User;
use yii\swiftmailer\Mailer;
use yii\web\Controller;

class SecurityController extends Controller {

    public function actionRegistration()
    {
        $form = new RegistrationForm();
        if (\Yii::$app->request->isPost && $form->load(\Yii::$app->request->post())) {
             if($form->validate()){
                $user = new User();
                $user->attributes = $form->attributes;
                $user->activkey = $this->module->encrypting(rand(0,10000));
                 if($this->module->emailRegistrationConfirm){
                     \Yii::$app
                         ->mailer
                         ->compose()
                         ->setFrom(\Yii::$app->params['supportEmail'])
                         ->setTo($user->email)
                         ->setSubject('Confirm your registration on '. \Yii::$app->name)
                         ->setHtmlBody('<a href="http://'.$_SERVER['HTTP_HOST'].'/user/security/email-confirm?hash='.$user->activkey.'">Click here for confirm registration on '.\Yii::$app->name.'</a>')
                         ->send();
                 } else {
                    $user->status = 1;
                 }

                if($user->save()){

                    if($user->status){
                        \Yii::$app->user->login($user);
                        \Yii::$app->session->setFlash('success','Добро пожаловать на '.\Yii::$app->name. ', '.$user->username);
                    } else {
                        \Yii::$app->session->setFlash('success','Please check your mailbox and confirm registration');
                    }

                    return $this->redirect('/');
                }
             }
        }

        return $this->render('registration',[
            'formModel' => $form,
        ]);

    }

    public function actionEmailConfirm($hash) {

        $user = User::findOne(['activkey' => $hash,'status' => 0]);
            if(!empty($user)) {
                $user->status = 1;
                $user->activkey = $this->module->encrypting(rand(0,1000));
                $user->save();
                \Yii::$app->user->login($user);
                \Yii::$app->session->setFlash('success','Добро пожаловать на '.\Yii::$app->name. ', '.$user->username);
            }
            return $this->redirect(['/']);
    }

    public function actionLogin(){
        if(\Yii::$app->user->isGuest){
            $model = new LoginForm();
            if(\Yii::$app->request->isPost && $model->load(\Yii::$app->request->post())){
                $user = $model->findByUsername($model->username); // пока так
                if(!empty($user)){
                    if($this->module->encrypting($model->password) == $user->password) {
                        if($user->status == 0) {
                            Yii::$app->session->setFlash('success','Данный аккаунт не активирован или отключен');
                            return $this->redirect(['/']);
                        }
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
        $formModel = new ResetPasswordForm();
        if(\Yii::$app->request->isPost && $formModel->load(\Yii::$app->request->post()) && $formModel->validate()){
                \Yii::$app
                    ->mailer
                    ->compose()
                    ->setFrom(\Yii::$app->params['supportEmail'])
                    ->setTo($formModel->email)
                    ->setSubject('Reset password on'. \Yii::$app->name)
                    ->setHtmlBody('<a href="http://'.$_SERVER['HTTP_HOST'].'/user/security/reset-password?hash='.$formModel->user->activkey.'">Click here for reset!</a>')
                    ->send();
                \Yii::$app->session->setFlash('success','Please check your email for reset password');
                return $this->redirect('/',301);
        } elseif (!empty(\Yii::$app->request->get('hash'))) {
                $user = User::findOne(['activkey' => \Yii::$app->request->get('hash')]);
                if(!empty($user)) {
                    $password = substr($this->module->encrypting(rand(0,1000)),0,8);
                    $user->password = $this->module->encrypting($password);
                    $user->activkey = $this->module->encrypting(rand(0,1000));
                    if($user->save()) {
                        \Yii::$app
                            ->mailer
                            ->compose()
                            ->setFrom(\Yii::$app->params['supportEmail'])
                            ->setTo($user->email)
                            ->setSubject('New password on'. \Yii::$app->name)
                            ->setHtmlBody('Your new password on '.\Yii::$app->name.': '.$password)
                            ->send();
                    }
                }
                \Yii::$app->session->setFlash('success','Check your email for new password');
                $this->redirect(['/user/security/login']);
        }

        return $this->render('reset_password',[
            'formModel' => $formModel,
        ]);
    }

}