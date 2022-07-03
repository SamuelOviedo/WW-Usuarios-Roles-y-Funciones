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

    // ----------------------------------------------------------------------
    //                             Sección de imports
    //-----------------------------------------------------------------------
    use Controllers\PublicController;
    use Dao\Mnt\Users as DaoUsers;
    use Views\Renderer;

    /**
    * Users(Usuarios)
    * Esta clase nos ayuda para poder inicializar todos los elementos
    * para inserción de un usuario
    * @category Public 
    * @package Controllers/Mnt;
    * @author Orlando J Betancourth <orlando.betancourth@gmail.com>
    * @license MIT http://
    * @link http://
    */

    class Users extends PublicController
    {
        /**
         * Obtiene todos los registros de Usuarios
         *
         * @return void
         */
        public function run():void
        {
            //Obtenemos los datos
            $viewUsers = array();
            $viewUsers["Users"] = DaoUsers::getUsers();
            error_log(json_encode($viewUsers));

            /* Este redender recibe dos parámetros:
            *  1. La dirección de la plantilla
            *  2. Los datos que se van a renderizar */
            Renderer::render('mnt/users', $viewUsers);
        }
    }
?>