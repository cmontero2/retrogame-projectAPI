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

    public function actions() {
        $actions = parent::actions();
        //Eliminamos acciones de crear y eliminar apuntes. Eliminamos update para personalizarla
        unset($actions['delete'], $actions['create'],$actions['update']);
        // Redefinimos el método que prepara los datos en el index
        $actions['index']['prepareDataProvider'] = [$this, 'indexProvider'];
        return $actions;
    }

    public function indexProvider() {
        $usuario=$_GET['usuario']??"";
        if($usuario != ""){
            return new ActiveDataProvider([
                'query' => UsuarioJuego::find()
                    ->where('usuario_id='.$usuario)
                    ->groupBy('juego_id') 
                    ->orderBy('fecha_id'),                    
                    'pagination' => [
                        'pageSize' => 3,
                    ],
                     
            ]);
        } else {
            return new ActiveDataProvider([
                'query' => UsuarioJuego::find()
            ]);
        }
    }
    
}
?>