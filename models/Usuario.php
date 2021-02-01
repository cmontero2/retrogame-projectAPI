<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property int $id
 * @property int $rol_id
 * @property int $nivel_foro_id
 * @property string $user
 * @property string|null $nombre
 * @property string $password
 * @property string $email
 * @property string|null $nacimiento
 * @property string $estado
 * @property string|null $poblacion
 * @property string|null $CIF
 * @property string|null $direccion
 * @property int|null $telefono
 * @property string $token
 *
 * @property Entrada[] $entradas
 * @property Juego[] $juegos
 * @property JuegoCategoria[] $juegoCategorias
 * @property NivelForo $nivelForo
 * @property Rol $rol
 * @property UsuarioJuego[] $usuarioJuegos
 */
class Usuario extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rol_id', 'nivel_foro_id', 'user', 'password', 'email', 'estado', 'token'], 'required'],
            [['rol_id', 'nivel_foro_id', 'telefono'], 'integer'],
            [['nacimiento'], 'safe'],
            [['user', 'poblacion'], 'string', 'max' => 30],
            [['nombre', 'password', 'email', 'token'], 'string', 'max' => 60],
            [['estado'], 'string', 'max' => 1],
            [['CIF'], 'string', 'max' => 9],
            [['direccion'], 'string', 'max' => 90],
            [['nivel_foro_id'], 'exist', 'skipOnError' => true, 'targetClass' => NivelForo::className(), 'targetAttribute' => ['nivel_foro_id' => 'id']],
            [['rol_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['rol_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rol_id' => 'Rol ID',
            'nivel_foro_id' => 'Nivel Foro ID',
            'user' => 'User',
            'nombre' => 'Nombre',
            'password' => 'password',
            'email' => 'Email',
            'nacimiento' => 'Nacimiento',
            'estado' => 'Estado',
            'poblacion' => 'Poblacion',
            'CIF' => 'Cif',
            'direccion' => 'Direccion',
            'telefono' => 'Telefono',
            'token' => 'Token',
        ];
    }

    /**
     * Gets query for [[Entradas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEntradas()
    {
        return $this->hasMany(Entrada::className(), ['usuario_id' => 'id']);
    }

    /**
     * Gets query for [[Juegos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJuegos()
    {
        return $this->hasMany(Juego::className(), ['empresa_id' => 'id']);
    }

    /**
     * Gets query for [[JuegoCategorias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJuegoCategorias()
    {
        return $this->hasMany(JuegoCategoria::className(), ['usuario_id' => 'id']);
    }

    /**
     * Gets query for [[NivelForo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNivelForo()
    {
        return $this->hasOne(NivelForo::className(), ['id' => 'nivel_foro_id']);
    }

    /**
     * Gets query for [[Rol]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRol()
    {
        return $this->hasOne(Rol::className(), ['id' => 'rol_id']);
    }

    /**
     * Gets query for [[UsuarioJuegos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioJuegos()
    {
        return $this->hasMany(UsuarioJuego::className(), ['usuario_id' => 'id']);
    }
    //copia
    public static function findByUsername($username) {
        return static::findOne(['usuario' => $username]);
      }
     
      public static function findIdentity($id) {
         return static::findOne($id);
      }
     
      public function getId() {
          return $this->id;
      }
     
      public function getAuthKey() { }
     
      public function validateAuthKey($authKey) { }
     
      // Comprueba que el password que se le pasa es correcto
      public function validatePassword($password) {
           return $this->password === md5($password); // Si se utiliza otra función de encriptación distinta a md5, habrá que cambiar esta línea
      }

      //genera un token para usuarios nuevos
      public function generateToken(){
        return random_bytes(5);
      }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $u = self::findOne(['token' => $token]);
        //if(!$u || $u->estado=="B") return false;
        return $u;
    }
}
