<?php
namespace app\controllers;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
use yii\data\ActiveDataProvider;
use app\models\UsuarioJuego;
 
class UsuariosJuegoController extends ApiController
{
    public $modelClass = 'app\models\UsuarioJuego';
    public $authenable=false;

    public function indexProvider() {
        $usuario=$_GET['usuario']??"";
        if($usuario != ""){
            return new ActiveDataProvider([
                'query' => UsuarioJuego::find()
                    ->where(['usuario_id'=> $usuario])
                    ->orderBy('fecha_id')  
            ]);
        } else {
            return new ActiveDataProvider([
                'query' => UsuarioJuego::find()
            ]);
        }
    }
    
}
?>