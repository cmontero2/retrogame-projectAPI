<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nivel_foro".
 *
 * @property int $id
 * @property string $nombre
 * @property int $puntos
 *
 * @property Usuario[] $usuarios
 */
class NivelForo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nivel_foro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'puntos'], 'required'],
            [['puntos'], 'integer'],
            [['nombre'], 'string', 'max' => 30],
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
            'puntos' => 'Puntos',
        ];
    }

    /**
     * Gets query for [[Usuarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['nivel_foro_id' => 'id']);
    }
}
