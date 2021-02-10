<?php
namespace app\controllers;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
 
class SeccionesController extends ApiController
{
    public $modelClass = 'app\models\Seccion';

    public $authenable=false;
    
}
?>