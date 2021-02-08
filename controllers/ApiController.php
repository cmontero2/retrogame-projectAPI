<?php 

namespace app\controllers;
 
use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\Cors;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
 
class ApiController extends \yii\rest\ActiveController {
       public $authenable=true;
 
        public function behaviors() {
                $behaviors = parent::behaviors();
                unset($behaviors['authenticator']);
                $behaviors['corsFilter'] = [
                        'class' => Cors::className(),
                        'cors' => [
                                'Origin' => ['*'],
                                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                                'Access-Control-Request-Headers' => ['*'],
                                'Access-Control-Allow-Credentials' => true,
                               'Access-Control-Max-Age' => 86400
                        ],
                ];
 
                if (!$this->authenable)
                        return $behaviors;
                $behaviors['authenticator'] = [
                        'class' => HttpBearerAuth::className(),
                        'except' => ['options', 'authenticate'],
                ];
 
                return $behaviors;
        }
}
?>