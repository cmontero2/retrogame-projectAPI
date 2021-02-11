<?php
namespace app\controllers;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use app\models\JuegoCategoria;

class JuegosCategoriaController extends ApiController
{
    public $modelClass = 'app\models\JuegoCategoria';

    public $authenable=false;

    public function actions() {
        $actions = parent::actions();
        unset($actions['delete'], $actions['create'],$actions['update']);
        $actions['index']['prepareDataProvider'] = [$this, 'indexProvider'];
        return $actions;
    }

    public function indexProvider() {
        $juegoCategoria=$_GET['juegoCategoria']??"";
        if($juegoCategoria != ""){
            return new ActiveDataProvider([
                'query' => JuegoCategoria::find()
                    ->where(['id'=>$juegoCategoria])
                    ->orderBy('nombre'),
                'pagination' => [
                'pageSize' => 3,
                    ],  
            ]);
        } else {
            return new ActiveDataProvider([
                'query' => JuegoCategoria::find()
            ]);
        }
    }
}
?>