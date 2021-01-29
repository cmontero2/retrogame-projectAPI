<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "entrada".
 *
 * @property int $id
 * @property string $titulo
 * @property string $texto
 * @property string $fecha
 * @property string $estado
 * @property int $usuario_id
 * @property int $seccion_id
 *
 * @property Comentario[] $comentarios
 * @property Seccion $seccion
 * @property Usuario $usuario
 */
class Entrada extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'entrada';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'texto', 'fecha', 'estado', 'usuario_id', 'seccion_id'], 'required'],
            [['texto'], 'string'],
            [['fecha'], 'safe'],
            [['usuario_id', 'seccion_id'], 'integer'],
            [['titulo'], 'string', 'max' => 60],
            [['estado'], 'string', 'max' => 1],
            [['seccion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Seccion::className(), 'targetAttribute' => ['seccion_id' => 'id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'texto' => 'Texto',
            'fecha' => 'Fecha',
            'estado' => 'Estado',
            'usuario_id' => 'Usuario ID',
            'seccion_id' => 'Seccion ID',
        ];
    }

    /**
     * Gets query for [[Comentarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentario::className(), ['entrada_id' => 'id']);
    }

    /**
     * Gets query for [[Seccion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeccion()
    {
        return $this->hasOne(Seccion::className(), ['id' => 'seccion_id']);
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'usuario_id']);
    }
}
