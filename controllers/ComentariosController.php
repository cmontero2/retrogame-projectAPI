<?php
namespace app\controllers;
use Yii;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use app\models\Comentario;
 
class ComentariosController extends ApiController
{
    public $modelClass = 'app\models\Comentario';

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
        $entrada=$_GET['entrada']??"";
        $id = $_GET['id']??"";
        if($entrada != ""){
            return new ActiveDataProvider([
                'query' => Comentario::find()
                    ->where(['entrada_id'=>$entrada])
                    ->orderBy('fecha')
            ]);
        } elseif($id != "" ){
            return new ActiveDataProvider([
                'query' => Comentario::find()
                    ->where(['id'=>$id])  
            ]);
        } else {
            return new ActiveDataProvider([
                'query' => Comentario::find()
            ]);
        }
    }
    
}
?>