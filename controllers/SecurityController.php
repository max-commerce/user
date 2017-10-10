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
                 
             }
        } else {

        }
    }

    public function actionLogin(){

    }

    public function actionLogout(){

    }

    public function actionResetPassword(){

    }

    public function actionChangePassword(){

    }
}