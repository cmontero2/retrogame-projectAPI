<?php
namespace app\controllers;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
 
class CategoriasController extends ApiController
{
    public $modelClass = 'app\models\Categoria';
    
    public $authenable=false;
    
}
?>