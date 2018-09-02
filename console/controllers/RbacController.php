<?php

namespace console\controllers;

/**
 * Assign roles for users
 *
 * @author Serhiy Yakymenko <serh.yakymenko@gmail.com>
 */

use yii\console\Controller;
use common\models\User;
use Yii;

class RbacController extends Controller
{
    public function actionAssign($role, $username)
    {
        $user = User::find()->where(['username' => $username])->one();
        if (!$user) {
            throw new InvalidParamException("There is no user \"$username\".");
        }

        $auth = Yii::$app->authManager;
        $roleObject = $auth->getRole($role);
        if (!$roleObject) {
            throw new InvalidParamException("There is no role \"$role\".");
        }

        $auth->assign($roleObject, $user->id);
    }
}
