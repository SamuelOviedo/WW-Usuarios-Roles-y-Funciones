<?php
    /**
    * PHP Version 8
    * Modelo de Datos para modelo
    *
    * @category Data_Model
    * @package  Models${1:modelo}
    * @author   Ericka Castellanos <erickacastellanosalv@gmail.com>
    * @license  Comercial http://
    *
    * @version 1.0.0
    *
    * @link http://url.com
    */
    namespace Dao\Mnt;

    //Como aqui haremos los procedimientos para cada mode del CRUD utilizamos
    //el Dao\Table para que nos permita usar las sentencias sql
    use Dao\Table;

    /**
     * Modelo de Datos para la tabla de Usuarios
     * con todos sus procedimientos dentro de la clase que se creará
     *
     * @category Data_Model
     * @package  Dao.Table
     * @author   Ericka Castellanos <erickacastellanosalv@gmail.com>
     * @license  Comercial http://
     *
     * @link http://url.com
    */
    class Users extends Table
    {
        /*
            CAMPOS DE LA TABLA USUARIOS
            `usercod` bigint(10) NOT NULL AUTO_INCREMENT,
            `useremail` varchar(80) DEFAULT NULL,
            `username` varchar(80) DEFAULT NULL,
            `userpswd` varchar(128) DEFAULT NULL,
            `userfching` datetime DEFAULT NULL,
            `userpswdest` char(3) DEFAULT NULL,
            `userpswdexp` datetime DEFAULT NULL,
            `userest` char(3) DEFAULT NULL,
            `useractcod` varchar(128) DEFAULT NULL,
            `userpswdchg` varchar(128) DEFAULT NULL,
            `usertipo` char(3) DEFAULT NULL COMMENT 'Tipo de Usuario, Normal, Consultor o Cliente',
        */
        /**
         * Esta función obtiene todos los usuarios
         * que están registrados en el sistema
         *
         * @return array
         */
        public static function getUsers()
        {
            $sqlstr = "Select * from usuario;";
            return self::obtenerRegistros($sqlstr, array());
        }

        /**
         * Función que obtiene cada usuario por medio de su código
         *
         * @param integer $usercod Código del usuario
         * 
         * @return void
         */
        public static function getIdUser(int $usercod) 
        {
            $sqlstr = "SELECT * from `usuario` where usercod=:usercod;";
            $sqlstrParameters = array("usercod" => $usercod);
            return self::obtenerUnRegistro($sqlstr, $sqlstrParameters);
        }

        /**
         * Agregar un nuevo Usuario
         *
         * @param [String] $useremail
         * @param [String] $username
         * @param [String] $userpswd
         * @param [datetime] $userfching
         * @param [String] $userpswdest
         * @param [datatime] $userpswdexp
         * @param [String] $userest
         * @param [String] $useractcod
         * @param [String] $userpswdchg
         * @param [String] $usertipo
         * @return void
         */
        public static function insertUser(
            $useremail,
            $username,
            $userpswd,
            $userfching,
            $userpswdest,
            $userpswdexp,
            $userest,
            $useractcod,
            $userpswdchg,
            $usertipo
            ) {
            $sqlstr = "INSERT INTO `usuario`
            (`useremail`, `username`, `userpswd`,
            `userfching`, `userpswdest`,`userpswdexp`,
            `userest`, `useractcod`,
            `userpswdchg`,`usertipo`)
            VALUES
            (:useremail, :username, :userpswd,
            :userfching, :userpswdest, :userpswdexp,
            :userest, :useractcod,
            :userpswdchg, :usertipo);
            ";
            $sqlstrParameters = [
               "useremail" => $useremail,
               "username" => $username,
               "userpswd" => $userpswd,
               "userfching" => $userfching,
               "userpswdest" => $userpswdest,
               "userpswdexp" => $userpswdexp,
               "userest" => $userest,
               "useractcod" => $useractcod,
               "userpswdchg" => $userpswdchg,
               "usertipo" => $usertipo
            ];
            return self::executeNonQuery($sqlstr, $sqlstrParameters);
        }

        /**
         * Actualización de los datos de un usuario
         *
         * @param [Integer] $usercod
         * @param [String] $useremail
         * @param [String] $username
         * @param [String] $userpswd
         * @param [datetime] $userfching
         * @param [String] $userpswdest
         * @param [datatime] $userpswdexp
         * @param [String] $userest
         * @param [String] $useractcod
         * @param [String] $userpswdchg
         * @param [String] $usertipo
         * @return void
         */
        public static function updateUser( 
            $username,
            $useremail,
            $userpswd,
            $userfching,
            $userpswdest,
            $userpswdexp,
            $userest,
            $useractcod,
            $userpswdchg,
            $usertipo,
            $usercod
            ) {
            //Sentencia para actualizar un usuario
            $sqlstr = "UPDATE `usuario` set
            `username`=:username, `useremail`=:useremail, `userpswd`=:userpswd,
            `userfching`=:userfching, `userpswdest`=:userpswdest,`userpswdexp`=:userpswdexp,
            `userest`=:userest, `useractcod`=:useractcod,
            `userpswdchg`=:userpswdchg,`usertipo`=:usertipo 
            where usercod =:usercod;";
            $sqlstrParameters = array(
               "useremail" => $useremail,
               "username" => $username,
               "userpswd" => $userpswd,
               "userfching" => $userfching,
               "userpswdest" => $userpswdest,
               "userpswdexp" => $userpswdexp,
               "userest" => $userest,
               "useractcod" => $useractcod,
               "userpswdchg" => $userpswdchg,
               "usertipo" => $usertipo,
               "usercod" => $usercod
            );
            return self::executeNonQuery($sqlstr, $sqlstrParameters);
        }

        /**
         * Eliminar un usuario
         *
         * @param [Integer] $usercod
         * @return void
         */
        public static function deleteUser($usercod)
        {
            $sqlstr = "DELETE from `usuario`
                where usercod=:usercod;";
                $sqlstrParameters = array(
                    "usercod" => $usercod
                );
            return self::executeNonQuery($sqlstr, $sqlstrParameters);
        }
    }
?>