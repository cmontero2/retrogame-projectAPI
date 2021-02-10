<?php
namespace app\controllers;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
 
class ComentariosController extends ApiController
{
    public $modelClass = 'app\models\Comentario';

    
}
?>