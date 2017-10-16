<?php
namespace maxcom\user\controllers;
use maxcom\user\models\ChangePasswordForm;
use maxcom\user\models\Profiles;
use maxcom\user\models\ProfilesFields;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ProfileController extends Controller {
    public $defaultAction = 'update';
    public $layout = 'profile';
    public function actionUpdate(){
        if(\Yii::$app->user->isGuest){
            throw new NotFoundHttpException();
        }
        $userModel = \Yii::$app->user->identity;
        $profile = $userModel->profile;
        if(empty($profile)){
            $profile = new Profiles();
            $profile->user_id = $userModel->getId();
        }
        if(\Yii::$app->request->isPost && $userModel->load(\Yii::$app->request->post()) && $userModel->save() && $profile->load(\Yii::$app->request->post()) && $profile->save()){
                \Yii::$app->session->setFlash('success','Profile settings sucessfully saved');
        }
        return $this->render('update',[
           'user' => $userModel,
           'profile' => $profile,
        ]);


    }
    public function actionChangePassword(){
        if(\Yii::$app->user->isGuest){
            throw new NotFoundHttpException();
        }
        $form = new ChangePasswordForm();
        if(\Yii::$app->request->isPost && $form->load(\Yii::$app->request->post()) && $form->save()) {
            \Yii::$app->session->set('success','Your password has been successfully updated!');
            return $this->redirect(['/user/profile']);
        }
        return $this->render('change-password',[
            'formModel' => $form,
        ]);
    }
}