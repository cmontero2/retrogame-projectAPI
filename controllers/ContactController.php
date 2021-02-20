<?php

namespace app\controllers;

use Yii;
use yii\rest\Controller;
use yii\filters\auth\CompositeAuth;
use yii\filters\Cors;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;

class ContactController extends Controller
{   

    public $enableCsrfValidation= false; 
    public $authenable=false;
 
    public function beforeAction($a){
            header('Access-Control-Allow-Origin: *');
            return parent::beforeAction($a);
    }
 
    public function behaviors() {
            $behaviors = parent::behaviors();
            unset($behaviors['authenticator']);
            $behaviors['corsFilter'] = [
                    'class' => Cors::className(),
                    'cors' => [
                            'Origin' => ['*'],
                            'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                            'Access-Control-Request-Headers' => ['*'],
                            'Access-Control-Allow-Credentials' => $this->authenable,
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

    public function actionSend() {

        $params=json_decode(file_get_contents("php://input"), false);

        $mensaje = $params->mensaje;
        $asunto = $params->asunto;
        $nombre = $params->nombre;
        $email = $params->email;
        Yii::$app->mailer->compose()
            ->setFrom('retrogame.project.daw2@gmail.com')
            ->setTo('retrogame.project.daw2@gmail.com')
            ->setSubject($asunto)
            ->setHtmlBody(
                    "<html>
                        <h4>Nombre: ".$nombre."</h4>
                        <p>Email: ".$email."</p>
                        <br>
                        <p>".$mensaje."</p>
                    </html>"
            )
            ->send()
        ;

    }
}

?>