<?php
namespace app\controllers;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use app\models\Juego;
 
class JuegosController extends ApiController
{
    public $modelClass = 'app\models\Juego';

    public $authenable=false;

    public function actions() {
        $actions = parent::actions();
        unset($actions['delete'], $actions['create'],$actions['update']);
        $actions['index']['prepareDataProvider'] = [$this, 'indexProvider'];
        return $actions;
    }

    public function indexProvider() {
        $juego=$_GET['juego']??"";
        if($juego != ""){
            return Juego::findOne($juego);
            
            /*
            return new ActiveDataProvider([
                'query' => Juego::findOne($juego)
                    //->where(['id'=>$juego])
            ]);*/
            

        } else {
            return Juego::find()->all();
            /*
            return new ActiveDataProvider([
                'query' => Juego::find()
            ]);*/
            
        }
    }
}
?>