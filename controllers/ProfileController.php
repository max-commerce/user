<?php

namespace PanteraDigital\YiiYii2User\controllers;

use PanteraDigital\YiiYii2User\models\ChangePasswordForm;
use PanteraDigital\YiiYii2User\models\Profiles;
use PanteraDigital\YiiYii2User\models\ProfilesFields;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ProfileController extends Controller
{
    public $defaultAction = 'update';
    public $layout = 'profile';

    /**
     * @return string
     * Execute this action will render profile form for update profile data or throw not found exception if user is guest
     * @throws NotFoundHttpException
     */
    public function actionUpdate()
    {
        if (\Yii::$app->user->isGuest) {
            throw new NotFoundHttpException();
        }

        $userModel = \Yii::$app->user->identity;
        $profile = $userModel->profile;
        if (empty($profile)) {
            $profile = new Profiles();
            $profile->user_id = $userModel->getId();
        }
        if (\Yii::$app->request->isPost && $userModel->load(\Yii::$app->request->post()) && $userModel->save() && $profile->load(\Yii::$app->request->post()) && $profile->save()) {
            \Yii::$app->session->setFlash('success', 'Profile settings sucessfully saved');
        }
        return $this->render('update', [
            'user' => $userModel,
            'profile' => $profile,
        ]);
    }

    /**
     * @return string|\yii\web\Response
     * Execute this action will change password of user or throw http not found exception if user is guest
     * @throws NotFoundHttpException
     */
    public function actionChangePassword()
    {
        if (\Yii::$app->user->isGuest) {
            throw new NotFoundHttpException();
        }
        $form = new ChangePasswordForm();
        if (\Yii::$app->request->isPost && $form->load(\Yii::$app->request->post()) && $form->save()) {
            \Yii::$app->session->set('success', 'Your password has been successfully updated!');
            return $this->redirect(['/user/profile']);
        }
        return $this->render('change-password', [
            'formModel' => $form,
        ]);
    }
}
