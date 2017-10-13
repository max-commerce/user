<?php
namespace maxcom\user\controllers;
use maxcom\user\models\Profiles;
use maxcom\user\models\ProfilesFields;
use yii\base\Controller;
use yii\web\NotFoundHttpException;

class ProfileController extends Controller {
    public $defaultAction = 'update';

    public function actionUpdate(){
        if(\Yii::$app->user->isGuest){
            throw new NotFoundHttpException();
        }
        $userModel = \Yii::$app->user->identity;
        $profile = $userModel->profile;
        
        if(\Yii::$app->request->isPost && $profile->load(\Yii::$app->request->post()) && $profile->save()){
                \Yii::$app->session->setFlash('success','Profile settings sucessfully saved');
        }
        return $this->render('update',[
           'user' => $userModel,
           'profile' => $profile,
        ]);


    }
}