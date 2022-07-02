<?php
/**
 * PHP Version 7.2
 *Mnt
 *
 * @category Controller
 * @package  Controllers\Mnt
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  Comercial http://
 * @version  CVS:1.0.0
 * @link     http://url.com
 */
namespace Controllers\Mnt;

//---------------------------------------------------------------
// Seccion de imports
//---------------------------------------------------------------
use Controllers\PublicController;
use Dao\Mnt\Roles as DaoRoles;
use Views\Renderer;

/**
 * Roles
 * 
 * @category Public
 * @package  Controllers\Mnt
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  MIT http://
 * @link     http://
 */
class Roles extends PublicController
{
    /**
     * Index run method
     *
     * @return void
     */
    public function run() :void
    {
       //code
       $viewData=array();
       $viewData["Roles"] = DaoRoles::getAll();
       Renderer::render('mnt/Roles',$viewData);
    }

}

?>

