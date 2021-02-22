<?php
    namespace app\controllers;
    use yii\rest\ActiveController;
    use yii\data\ActiveDataProvider;
    use app\models\Usuario;
    use Yii;
use yii\web\UploadedFile;

class UsersController extends ApiController
{
    public $modelClass = 'app\models\Usuario';
    public $authenable=false;

    //para autentificacion en el frontend devolviendo su token
    public function actionAuthenticate(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Si se envían los datos en formato raw dentro de la petición http, se recogen así:
            
            
            $params=json_decode(file_get_contents("php://input"), false);
            @$username=$params->username;
            @$password=$params->password;
        
            
            // Si se envían los datos de la forma habitual (form-data), se reciben en $_POST:
            /*
            $username=$_POST['username'];
            $password=$_POST['password' ];
            */
        
            
            if($u=\app\models\Usuario::findOne(['user'=>$username]))
                if($u->password==md5($password)) {//o crypt, según esté en la BD
        
                    return ['token'=>$u->token,'id'=>$u->id,'user'=>$u->user, 'rol_id'=>$u->rol_id];
                }
        
            return ['error'=>'Usuario incorrecto. '.$username];
        }
    }

    /* Intento de upload desde backend */
    public function actionUpload() {
    
        $request = Yii::$app->request;
        
        $_FILES['foto'];
        
        if(isset($_FILES["foto"]['tmp_name'])){               
                    
            $filename = $_FILES["foto"]["name"]; //Obtenemos el nombre original del archivo
            $source = $_FILES["foto"]["tmp_name"]; //Obtenemos un nombre temporal del archivo                    
            $directorio = '../assets/img/'; //Declaramos un  variable con la ruta donde guardaremos los archivos

            
            $dir=opendir($directorio); //Abrimos el directorio de destino
            $target_path = $directorio.'/'.$filename; //Indicamos la ruta de destino, así como el nombre del archivo
            
            //Movemos y validamos que el archivo se haya cargado correctamente
            //El primer campo es el origen y el segundo el destino
            if(move_uploaded_file($source, $target_path)) {	
                //"El archivo $filename se ha almacenado en forma exitosa.<br>";
                } else {	
                $error = "Ha ocurrido un error, por favor inténtelo de nuevo.";
            }
            closedir($dir); //Cerramos el directorio de destino
        }
                
    }
            
           
}

          


?>