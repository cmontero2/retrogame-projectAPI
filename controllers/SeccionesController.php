<?php
namespace app\controllers;
use Yii;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use app\models\Seccion;
 
class SeccionesController extends ApiController
{
    public $modelClass = 'app\models\Seccion';
    
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
    $id = $_GET['id']??"";
    if($seccion != ""){
        return new ActiveDataProvider([
            'query' => Seccion::find()
                ->where(['seccion_id'=>$seccion])
                
        ]);
    } elseif($id != "" ){
        return new ActiveDataProvider([
            'query' => Seccion::find()
                ->where(['id'=>$id])  
        ]);
    } else {
        return new ActiveDataProvider([
            'query' => Seccion::find()
        ]);
    }
}
    
}
?>