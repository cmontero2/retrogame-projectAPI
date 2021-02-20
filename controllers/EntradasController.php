<?php
namespace app\controllers;
use Yii;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use app\models\Entrada;
 
class EntradasController extends ApiController
{
    public $modelClass = 'app\models\Entrada';

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
        $seccion=$_GET['seccion']??"";
        $seccionId=$_GET['seccionId']??"";
        $id = $_GET['id']??"";
        if($seccion != ""){
            return new ActiveDataProvider([
                'query' => Entrada::find()
                    ->where(['seccion_id'=>$seccion,
                    'estado' => "A"])
                    ->orderBy('fecha'),
                'pagination' => [
                'pageSize' => 3,
                    ],  
            ]);
        } elseif($id != "" ){
            return new ActiveDataProvider([
                'query' => Entrada::find()
                    ->where(['id'=>$id])  
            ]);
        } elseif($seccionId != ""){
            return new ActiveDataProvider([
                'query' => Entrada::find()
                    ->where(['seccion_id'=>$seccionId,
                    'estado' => "A"])
                    ->orderBy('fecha')
            ]);
        } else {
            return new ActiveDataProvider([
                'query' => Entrada::find()
            ]);
        }
    }
    
}
?>