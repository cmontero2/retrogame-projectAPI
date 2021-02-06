<?php
namespace app\controllers;
use Yii;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use app\models\Entrada;
 
class EntradasController extends ActiveController
{
    public $modelClass = 'app\models\Entrada';
/*
    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
           'class' => HttpBearerAuth::className(),
           'except' => ['options', 'authenticate'],
        ];
        return $behaviors;
    }
    */

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
                ->where('seccion_id='.$seccion.' and estado = "A"')
                ->limit(3)
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