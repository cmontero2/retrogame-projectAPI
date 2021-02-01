<?php
namespace app\controllers;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
 
class RolesController extends ActiveController
{
    public $modelClass = 'app\models\Rol';

    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
           'class' => HttpBearerAuth::className(),
           'except' => ['options', 'authenticate'],
        ];
        return $behaviors;
    }
}
?>