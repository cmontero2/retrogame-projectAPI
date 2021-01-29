<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comentario".
 *
 * @property int $id
 * @property string $texto
 * @property string $fecha
 * @property int $entrada_id
 *
 * @property Entrada $entrada
 */
class Comentario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comentario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['texto', 'fecha', 'entrada_id'], 'required'],
            [['fecha'], 'safe'],
            [['entrada_id'], 'integer'],
            [['texto'], 'string', 'max' => 1000],
            [['entrada_id'], 'exist', 'skipOnError' => true, 'targetClass' => Entrada::className(), 'targetAttribute' => ['entrada_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'texto' => 'Texto',
            'fecha' => 'Fecha',
            'entrada_id' => 'Entrada ID',
        ];
    }

    /**
     * Gets query for [[Entrada]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEntrada()
    {
        return $this->hasOne(Entrada::className(), ['id' => 'entrada_id']);
    }
}
