<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario_juego".
 *
 * @property int $juego_id
 * @property int $usuario_id
 * @property string $fecha_id
 *
 * @property Juego $juego
 * @property Usuario $usuario
 */
class UsuarioJuego extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario_juego';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['juego_id', 'usuario_id', 'fecha_id'], 'required'],
            [['juego_id', 'usuario_id'], 'integer'],
            [['fecha_id'], 'safe'],
            [['juego_id'], 'exist', 'skipOnError' => true, 'targetClass' => Juego::className(), 'targetAttribute' => ['juego_id' => 'id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'juego_id' => 'Juego ID',
            'usuario_id' => 'Usuario ID',
            'fecha_id' => 'Fecha ID',
        ];
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

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'usuario_id']);
    }
    /*
    public function fields(){
        return ['id', 'fecha_id', 'juego'];
    }
    */
}
