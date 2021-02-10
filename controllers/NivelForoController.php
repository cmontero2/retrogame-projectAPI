<?php
namespace app\controllers;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
 
class NivelForoController extends ApiController
{
    public $modelClass = 'app\models\NivelForo';

    
}
?>