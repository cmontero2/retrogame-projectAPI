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
        unset($actions['delete'], $actions['create']);
        $actions['index']['prepareDataProvider'] = [$this, 'indexProvider'];

        return $actions;
    }

    public function indexProvider() {
        $empresa=$_GET['empresa']??"";
        $juego=$_GET['juego']??"";
        if($empresa != ""){
            return new ActiveDataProvider([
                'query' => Juego::find($empresa)
                    ->where(['empresa_id' => $empresa])
            ]);
            
            /*
            return new ActiveDataProvider([
                'query' => Juego::findOne($juego)
                    //->where(['id'=>$juego])
            ]);*/
            

        } elseif($juego != "") {

            return Juego::findOne($juego);

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