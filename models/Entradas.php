<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "entradas".
 *
 * @property int $id
 * @property string $fecha_hora
 * @property string|null $texto
 * @property int|null $aceptado
 * @property int $categorias_id
 * @property int $usuarios_id
 *
 * @property Comentarios[] $comentarios
 * @property Usuarios $usuarios
 * @property Categorias $categorias
 * @property Valoraciones[] $valoraciones
 */
class Entradas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'entradas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['categorias_id'], 'required'],
            [['fecha_hora'], 'default', 'value' => date('Y-m-d H:i:s')],
            [['usuarios_id'], 'default', 'value' =>Yii::$app->user->id ],
            [['aceptado'], 'default', 'value' =>'0'],
            [['texto'], 'string'],
            [['aceptado', 'categorias_id', 'usuarios_id'], 'integer'],
            [['usuarios_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['usuarios_id' => 'id']],
            [['categorias_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categorias::className(), 'targetAttribute' => ['categorias_id' => 'id']],      
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fecha_hora' => 'Fecha Hora',
            'texto' => 'Texto',
            'aceptado' => 'Aceptado',
            'categorias_id' => 'Categorias ID',
            'usuarios_id' => 'Usuarios ID',
        ];
    }

    /**
     * Gets query for [[Comentarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentarios::className(), ['entradas_id' => 'id']);
    }

    /**
     * Gets query for [[Usuarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'usuarios_id']);
    }

    /**
     * Gets query for [[Categorias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categorias::className(), ['id' => 'categorias_id']);
    }

    /**
     * Gets query for [[Valoraciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getValoraciones()
    {
        return $this->hasMany(Valoraciones::className(), ['entradas_id' => 'id']);
    }

    //guardar valores antes
    public function beforeSave($insert){
        //para palabras ofensivas
        /*
        if(strpos($this->texto. 'coño')){
            $this->addError('texto', 'Palabra no permitida');
        }
        */
        if($this->isNewRecord){
            $this->usuarios_id= Yii::$app->user->id;

            //que se aprueben todas las entradas hechas por admin
            //echo Yii::$app->user->identity->usuario;die;
            if(Yii::$app->user->identity->usuario=='admin'){
                $this->estado=1;
            } else {
                $this->estado=0;
            }
            
        }
        return parent::beforeSave($insert);
    }
    //devuelve si o no del estado
    public function getestado_text(){
        return $this->estado == 'P'? 'pendiente':'activo';
    }

    //devuelve nombre usuario
    public function getusuario_id(){
        return $this->usuario->id;
    }

    //devuelve descripcion de la categoria
    public function gettexto(){
        return $this->texto;
    }


    //sacar info de la categoria
    public function fields(){
        /*
        $fields = parent::fields();
        $fields[]='categoria_descri';
        return $fields;
        */
        return array_merge(parent::fields(), ['texto', 'usuario_id']);//estado_text
    } 

    public function extrafields(){
        return ['entradas'];
    }
}
