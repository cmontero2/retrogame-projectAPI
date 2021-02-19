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
        unset($actions['delete'],$actions['update']);
        $actions['index']['prepareDataProvider'] = [$this, 'indexProvider'];
        return $actions;
    }

    public function indexProvider() {
        $categoriaId=$_GET['categoria']??"";
        if($categoriaId != ""){
            return new ActiveDataProvider([
                'query' => JuegoCategoria::find()
                    ->where(['categoria_id'=>$categoriaId]),
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