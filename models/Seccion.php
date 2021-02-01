<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "seccion".
 *
 * @property int $id
 * @property string $nombre
 * @property int|null $juego_id
 *
 * @property Entrada[] $entradas
 * @property Juego $juego
 */
class Seccion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seccion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['juego_id'], 'integer'],
            [['nombre'], 'string', 'max' => 400],
            [['juego_id'], 'exist', 'skipOnError' => true, 'targetClass' => Juego::className(), 'targetAttribute' => ['juego_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'juego_id' => 'Juego ID',
        ];
    }

    /**
     * Gets query for [[Entradas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEntradas()
    {
        return $this->hasMany(Entrada::className(), ['seccion_id' => 'id']);
    }

    /**
     * Gets query for [[Juego]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJuego()
    {
        return $this->hasOne(Juego::className(), ['id' => 'juego_id']);
    }
}
