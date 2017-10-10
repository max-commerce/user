<?php
namespace maxcom\user\controllers;
use maxcom\user\models\Profiles;
use maxcom\user\models\User;
use yii\web\Controller;

class SecurityController extends Controller {

    public function actionRegistration()
    {
        $userModel = new User();
        if (\Yii::$app->request->isPost && $userModel->load(\Yii::$app->request->post())) {
             if($userModel->save()){
                \Yii::$app->user->login($userModel,$this->module->loginDuartion);
             }
        } else {
           return $this->render('registration',[
                'userModel' => $userModel,
            ]);
        }
    }

    public function actionLogin(){
        if(\Yii::$app->user->isGuest){
            $model = new User();
            if(\Yii::$app->request->isPost && $model->load(\Yii::$app->request->post())){
                $user = $model->findByUsername($model->username); // пока так

                if(!empty($user)){
//                    echo $this->module->encrypting($model->password) . ' ---- '. $user->password; exit;
                    if($this->module->encrypting($model->password) == $user->password) {
                        \Yii::$app->user->login($user,$this->module->loginDuration);
                        \Yii::$app->session->setFlash('success','Добро пожаловать,'. $user->username);
                        return $this->redirect('/');
                    }
                } else {
                    $model->addError('Ошибка авторизации');
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