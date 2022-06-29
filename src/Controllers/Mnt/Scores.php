<?php

namespace Controllers\Mnt;

//---------------------------------------------------------------
// Seccion de imports
//---------------------------------------------------------------
use Controllers\PublicController;
use Dao\Mnt\Scores as DaoScores;
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
       $viewData["Scores"] = DaoScores::getAll();
       Renderer::render('mnt/Scores',$viewData);
    }

}

?>
