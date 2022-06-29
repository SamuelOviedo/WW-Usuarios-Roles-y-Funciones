<?php

namespace Controllers\Mnt;

//---------------------------------------------------------------
// Seccion de imports
//---------------------------------------------------------------
use Controllers\PublicController;
use Dao\Mnt\Funciones as DaoFunciones;
use Views\Renderer;


class Scores extends PublicController
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
       $viewData["Funciones"] = DaoFunciones::getAll();
       Renderer::render('mnt/Funciones',$viewData);
    }

}

?>