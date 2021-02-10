<?php
namespace app\controllers;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
 
class JuegosController extends ApiController
{
    public $modelClass = 'app\models\Juego';

    
}
?>