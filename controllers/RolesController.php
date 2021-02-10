<?php
namespace app\controllers;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
 
class RolesController extends ApiController
{
    public $modelClass = 'app\models\Rol';

    
}
?>