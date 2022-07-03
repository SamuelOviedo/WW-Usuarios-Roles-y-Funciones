<?php
    /**
     * PHP Versión 8.0
     * Mnt
     * 
     * @category Controller 
     * @package Controllers/Mnt;
     * @author Orlando J Betancourth <orlando.betancourth@gmail.com>
     * @license Comercial http://
     * @version CVS:1.0.0
     * @link http://url.com
    */
    namespace Controllers\Mnt;

    // ----------------------------------------------------------------------//
    //                             Sección de imports                        //
    //-----------------------------------------------------------------------//
    use Controllers\PublicController;
    use Views\Renderer;
    use Utilities\Validators;
    use Dao\Mnt\Users;

    /**
     * Users(Usuario)
     * Esta clase contiene las validaciones necesarias
     * al momento de realizar una configuración a cada
     * uno de los usuarios del sistema.
     * @category Public 
     * @package Controllers/Mnt;
     * @author Orlando J Betancourth <orlando.betancourth@gmail.com>
     * @license MIT http://
     * @link http://
    */
    class User extends PublicController
    {
        //Definición de arreglos necesarios 
        private $viewUsers = array();
        private $estadoUser = array();
        private $estadoPSW = array();
        private $modeDesc = array();
        private $cargoUser = array();

        public function run(): void
        {
            //Función para inicializar los valores
            $this->beginning();

           //Realizamos las validaciones correspondientes
           /************* METODO GET *************/
           if (!$this->isPostBack()) {
               $this->processGet();
           }

           /************ METODO POST ***********/
           if ($this->isPostBack()) {
               $this->processPost();
           }

           // Vamos a ejecutar siempre esta función ya que nos permitirá
           //poder ver las ediciones de cada formulario
           $this->processView();

            /* Este redender recibe dos parámetros:
             *  1. La dirección de la plantilla
            *  2. Los datos que se van a renderizar
            */
            Renderer::render('mnt/user', $this->viewUsers);
        }

        /**
         * Función que inicializa las variables y los 
         * arreglos del formulario Usuario
         *
         * @return void
         */
        private function beginning()
        {
            $this->viewUsers[] = array();
            $this->viewUsers["mode"] = "";
            $this->viewUsers["mode_desc"] = "";
            $this->viewUsers["crsf_token"] = ""; //Sirve para validar que lo que estoy realizando está autorizado por mi servidor
            $this->viewUsers["usercod"] = "";
            $this->viewUsers["username"] = "";
            $this->viewUsers["error_username"] = array();
            $this->viewUsers["useremail"] = "";
            $this->viewUsers["error_useremail"] = array();
            $this->viewUsers["userpswd"] = "";
            $this->viewUsers["error_userpswd"] = array();
            $this->viewUsers["userfching"] = "";
            $this->viewUsers["error_userfching"] = array();
            $this->viewUsers["userpswdest"] = "";
            $this->viewUsers["userpswdestArr"] = array();
            $this->viewUsers["userpswdexp"] = "";
            $this->viewUsers["error_userpswdexp"] = array();
            $this->viewUsers["userest"] = "";
            $this->viewUsers["userestArr"] = array();
            $this->viewUsers["useractcod"] = "";
            $this->viewUsers["error_useractcod"] = array();
            $this->viewUsers["userpswdchg"] = "";
            $this->viewUsers["error_userpswdchg"] = array();
            $this->viewUsers["usertipo"] = "";
            $this->viewUsers["usertipoArr"] = array();
            $this->viewUsers["btnEnviarText"] = "Guardar";
            $this->viewUsers["readonly"] = false; //Determina si los datos del formulario son solo lectura
            $this->viewUsers["showBtn"] = true; //Determina si se muestran los botones o no
            
            //Inicialización de los arreglos
            $this->modeDesc = array(
                "INS"=>"Nuevo Usuario",
                "UPD"=>"Editando %s %s",
                "DSP"=>"Detalle de %s %s",
                "DEL"=>"Eliminado %s %s"
            );

            $this->estadoUser = array(
                array("value" => "ACT", "text" => "Activo"),
                array("value" => "INA", "text" => "Inactivo"),
            );

            $this->estadoPSW = array(
                array("value" => "ACT", "text" => "Activa"),
                array("value" => "EVL", "text" => "Evaluando"),
                array("value" => "INA", "text" => "Inactiva"),
            );

            $this->cargoUser = array(
                array("value" => "NRM", "text" => "Normal"),
                array("value" => "CNS", "text" => "Consultor"),
                array("value" => "CLT", "text" => "Cliente"),
                array("value" => "ADM", "text" => "Administrador"),
            );

            //Igualamos la variable del formulario para hacer referencia
            //a su inicialización con los valores del arreglo aquí
            $this->viewUsers["usertipoArr"] = $this->cargoUser;
            $this->viewUsers["userestArr"] = $this->estadoUser;
            $this->viewUsers["userpswdestArr"] = $this->estadoPSW;
        }

        /**
         * Obtención de los datos del formulario
         * para así poder trabajar con la información extraida.
         *
         * @return void
         */
        private function processGet()
        {
            //Verificamos si existen
            if (isset($_GET["mode"])) {
                //Definimos el arreglo del mode
                $this->viewUsers["mode"] = $_GET["mode"];
                if (!isset($this->modeDesc[$this->viewUsers["mode"]])) {
                    error_log('Error: (User) Mode solicitado no existe');
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt_users", //Dirección del redireccionamiento
                        "No se puede procesar su solicitud" //Mensaje al usuario
                    );
                }

                //Extraemos el código que trae el método get
                if ($this->viewUsers["mode"] !== "INS" && isset($_GET["id"])) {
                    //Como vemos que existe entonces lo asignamos al atributo de Get id
                    $this->viewUsers["usercod"] = intval($_GET["id"]);

                    //Obtenemos los datos del modelo
                    $tmpUser = Users::getIdUser($this->viewUsers["usercod"]);
                    error_log(json_encode($tmpUser));

                    //Unimos los arreglos para sustituir los valores que vienen en el actual
                    \Utilities\ArrUtils::mergeFullArrayTo($tmpUser, $this->viewUsers);
                }
            }
        }

        /**
         * Esta función se encarga de traer los datos que fueron ingresados
         * por el usuario, realiza las validaciones correspondientes para
         * asi poder trabajar con ellos según la petición que se ejecute.
         *
         * @return void
         */
        private function processPost()
        {
            //Validamos la entrada de datos por lo que debemos siempre
            //realizar validaciones con los datos.
            $errors = false;

            //Seguridad en la obtención de datos
            \Utilities\ArrUtils::mergeArrayTo($_POST, $this->viewUsers);
            if(isset($_SESSION[$this->name . "crsf_token"])
                && $_SESSION[$this->name . "crsf_token"] !== $this->viewUsers["crsf_token"]
            ) {
                \Utilities\Site::redirectToWithMsg(
                  "index.php?page=mnt_users",
                  "ERROR: Algo inesperado sucedió con la petición, Intente de nuevo"
                );
            }

            //Validaciones de los datos que vienen, que los campos no queden vacios
            if (Validators::IsEmpty(($this->viewUsers["username"]))) {
                $this->viewUsers["error_username"] [] 
                    = "Por favor escriba el nombre de usuario";
                $errors = true;
            }

            if (Validators::IsEmpty(($this->viewUsers["useremail"]))) {
                $this->viewviewUsersData["error_useremail"] [] 
                    = "Escriba el correo de usuario";
                $errors = true;
            }

            if (Validators::IsEmpty(($this->viewUsers["userpswd"]))) {
                $this->viewUsers["error_userpswd"] [] 
                    = "Es requerida la contraseña";
                $errors = true;
            }

            if (Validators::IsEmpty(($this->viewUsers["userfching"]))) {
                $this->viewUsers["error_userfching"] [] 
                    = "Es necesaria la fecha de ingreso";
                $errors = true;
            }

            if (Validators::IsEmpty(($this->viewUsers["userpswdexp"]))) {
                $this->viewUsers["error_userpswdexp"] [] 
                    = "Escriba la fecha de expiración";
                $errors = true;
            }

            if (Validators::IsEmpty(($this->viewUsers["useractcod"]))) {
                $this->viewUsers["error_useractcod"] [] 
                    = "Escriba el estado del código";
                $errors = true;
            }

            if (Validators::IsEmpty(($this->viewUsers["userpswdchg"]))) {
                $this->viewUsers["error_userpswdchg"] [] 
                    = "Escriba el cambio que hizo";
                $errors = true;
            }

            error_log(json_encode($this->viewUsers));

            //Modificaciones a los registros
            if (!$errors) {
                $response = null;

                //Enviamos un mensaje al verificar que se ha hecho
                switch($this->viewUsers["mode"]) {
                    case 'INS':
                        $response = Users::insertUser(
                            $this->viewUsers["useremail"],
                            $this->viewUsers["username"],
                            $this->viewUsers["userpswd"],
                            $this->viewUsers["userfching"],
                            $this->viewUsers["userpswdest"],
                            $this->viewUsers["userpswdexp"],
                            $this->viewUsers["userest"],
                            $this->viewUsers["useractcod"],
                            $this->viewUsers["userpswdchg"],
                            $this->viewUsers["usertipo"]
                        );

                        //Si todos los datos fueron ingresados le informamos al usuario
                        //que se ha guarado el registro
                        if ($response) {
                            \Utilities\Site::redirectToWithMsg(
                                "index.php?page=mnt_users",
                                "Usuario agregado correctamente!"
                            );
                        }
                    break;

                    case 'UPD':
                        $response = Users::updateUser(
                            $this->viewUsers["useremail"],
                            $this->viewUsers["username"],
                            $this->viewUsers["userpswd"],
                            $this->viewUsers["userfching"],
                            $this->viewUsers["userpswdest"],
                            $this->viewUsers["userpswdexp"],
                            $this->viewUsers["userest"],
                            $this->viewUsers["useractcod"],
                            $this->viewUsers["userpswdchg"],
                            $this->viewUsers["usertipo"],
                            intval($this->viewUsers["usercod"])
                        );
                        if ($response) {
                            \Utilities\Site::redirectToWithMsg(
                                "index.php?page=mnt_users",
                                "Datos de Usuario actualizados correctamente!"
                            );
                        }
                    break;

                    case 'DEL':
                        $response = Users::deleteUser(
                            intval($this->viewUsers["usercod"])
                        );
                        if ($response) {
                            \Utilities\Site::redirectToWithMsg(
                                "index.php?page=mnt_users",
                                "Se ha eliminado el usuario correctamente!"
                            );
                        }
                    break;
                }
            }
        }

        /**
         * Función que nos permite motrar la información correspondiente
         * en cada uno de los formularios y métodos que se ejecutarán
         *
         * @return void
         */
        private function processView()
        {
            //Verificamos que mode es el que se está ejecutando
            if ($this->viewUsers["mode"] === "INS") {
                $this->viewUsers["mode_desc"] = $this->modeDesc["INS"];
                $this->viewUsers["btnEnviarText"] = "Agregar Usuario";
            }
            else {
                $this->viewUsers["mode_desc"] = sprintf(
                    $this->modeDesc[$this->viewUsers["mode"]],
                    $this->viewUsers["usercod"],
                    $this->viewUsers["username"]
                ) ;

                $this->viewUsers["usertipoArr"]
                  = \Utilities\ArrUtils::objectArrToOptionsArray(
                  $this->cargoUser,
                  'value',
                  'text',
                  'value',
                  $this->viewUsers["usertipo"]
                );

                $this->viewUsers["userestArr"]
                  = \Utilities\ArrUtils::objectArrToOptionsArray(
                  $this->estadoUser,
                  'value',
                  'text',
                  'value',
                  $this->viewUsers["userest"]
                );

                $this->viewUsers["userpswdestArr"]
                  = \Utilities\ArrUtils::objectArrToOptionsArray(
                  $this->estadoPSW,
                  'value',
                  'text',
                  'value',
                  $this->viewUsers["userpswdest"]
                );

                if ($this->viewUsers["mode"] == "DSP") {
                    $this->viewUsers["readonly"] = true;
                    $this->viewUsers["showBtn"] = false;
                }
      
                if ($this->viewUsers["mode"] == "DEL") {
                $this->viewUsers["readonly"] = true;
                $this->viewUsers["btnEnviarText"] = "Eliminar";
                }
    
                if ($this->viewUsers["mode"] == "UPD") {
                $this->viewUsers["btnEnviarText"] = "Actualizar";
                }
            }

            //Mecanismo de seguridad
            //la llave se llamará con una serie de crsf_token y el valor establecido será
            //una fecha con milisegundos y se le concatena el nombre y sera un valor único
            $this->viewUsers["crsf_token"] = md5(getdate()[0] . $this->name);
            $_SESSION[$this->name . "crsf_token"] = $this->viewUsers["crsf_token"]; 
        }
    }
?>
