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
        } else {
            return new ActiveDataProvider([
                'query' => Entrada::find()
            ]);
        }
    }
    
}
?>