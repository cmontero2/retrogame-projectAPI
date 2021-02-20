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
        unset($actions['delete']);
        $actions['index']['prepareDataProvider'] = [$this, 'indexProvider'];

        return $actions;
    }

    public function indexProvider() {
        $empresa=$_GET['empresa']??"";
        $juego=$_GET['juego']??"";
        $nombre=$_GET['nombre']??"";
        $visitas=$_GET['visitas']??"";
        if($empresa != ""){
            return new ActiveDataProvider([
                'query' => Juego::find($empresa)
                    ->where(['empresa_id' => $empresa])
                    ->andWhere(['estado' => 'A'])
            ]);
            
            /*
            return new ActiveDataProvider([
                'query' => Juego::findOne($juego)
                    //->where(['id'=>$juego])
            ]);*/
            

        } elseif($juego != "") {

            return Juego::findOne($juego);

        } elseif($nombre != "") {

            return new ActiveDataProvider([
                'query' => Juego::find($nombre)
                    ->where(['nombre' => $nombre])
            ]);

        } elseif($visitas != "") {

            return new ActiveDataProvider([
                'query' => Juego::find()
                    ->where(['estado' => 'A'])
                    ->orderBy(['visitas' => SORT_DESC])
            ]);

        } else {
            
            return Juego::find()->where(['estado' => 'A'])->all();
            /*
            return new ActiveDataProvider([
                'query' => Juego::find()
            ]);*/
            
        }
    }

    public function actionPrint() {
        return ['token' => '1234593', 'nombre' => 'hola'];
    }
}
?>