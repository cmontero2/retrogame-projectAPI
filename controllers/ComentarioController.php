<?php
namespace app\controllers;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
 
class ComentarioController extends ActiveController
{
    public $modelClass = 'app\models\Comentario';

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