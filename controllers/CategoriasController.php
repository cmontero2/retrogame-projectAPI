<?php
namespace app\controllers;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use app\models\Categoria;

class CategoriasController extends ApiController
{
    public $modelClass = 'app\models\Categoria';
    
    public $authenable=false;
    
    public function actions() {
        $actions = parent::actions();
        unset($actions['delete'], $actions['create'],$actions['update']);
        $actions['index']['prepareDataProvider'] = [$this, 'indexProvider'];
        return $actions;
    }

    public function indexProvider() {
        $categoria=$_GET['categoria']??"";
        if($categoria != ""){
            return new ActiveDataProvider([
                'query' => Categoria::find()
                    ->where(['id'=>$categoria])
                    ->orderBy('nombre'),
                'pagination' => [
                'pageSize' => 3,
                    ],  
            ]);
        } else {
            return new ActiveDataProvider([
                'query' => Categoria::find()
            ]);
        }
    }
}
?>