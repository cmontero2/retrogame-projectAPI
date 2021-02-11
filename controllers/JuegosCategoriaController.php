<?php
namespace app\controllers;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
 
class JuegosCategoriaController extends ApiController
{
    public $modelClass = 'app\models\JuegoCategoria';

    public $authenable=false;
}
?>