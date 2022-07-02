<?php
/**
 * PHP Version 7
 * Modelo de Datos para modelo
 *
 * @category Data_Model
 * @package  Models${1:modelo}
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  Comercial http://
 *
 * @version 1.0.0
 *
 * @link http://url.com
 */

namespace Dao\Mnt;

use Dao\Table;

/**
 * Modelo de Datos para la tabla de Roles
 *
 * @category Data_Model
 * @package  Dao.Table
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  Comercial http://
 *
 * @link http://url.com
 */
class Roles extends Table
{
    /*
        `rolescod` varchar(15) NOT NULL,
        `rolesdsc` varchar(45) DEFAULT NULL,
        `rolesest` char(3) DEFAULT NULL,
    */
    /**
     * Obtiene todos los registros de Roles
     *
     * @return array
     */
    public static function getAll()
    {
        $sqlstr = "Select * from Roles;";
        return self::obtenerRegistros($sqlstr, array());
    }
    /**
     * Get Producto By Id
     *
     * @param int $rolescod Codigo del Producto
     *
     * @return array
     */
    public static function getById(string $rolescod)
    {
        $sqlstr = "SELECT * from `Roles` where rolescod = :rolescod;";
        $sqlParams = array("rolescod" => $rolescod);
        return self::obtenerUnRegistro($sqlstr, $sqlParams);
    }

    public static function insert(
        $rolescod,
        $rolesdsc,
        $rolesest,
       
    ) {
        $sqlstr =" INSERT INTO `roles`
(`rolescod`, `rolesdsc`, `rolesest`)
VALUES
(:rolescod, :rolesdsc, :rolesest);
";

        $sqlParams = [
            "rolescod" => $rolescod ,
            "rolesdsc" => $rolesdsc ,
            "rolesest" => $rolesest
        ];
        return self::executeNonQuery($sqlstr, $sqlParams);
    }
   
    public static function update(
        $rolesdsc,
        $rolesest,
        $rolescod,
    ) {
        $sqlstr = "UPDATE `roles` SET
`rolesdsc` = :rolesdsc,
`rolesest` = :rolesest
where rolescod = :rolescod;";
        
        $sqlParams = array(
            "rolesdsc" => $rolesdsc,
            "rolesest" => $rolesest,
            "rolescod" => $rolescod
        );
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

   
    public static function delete($rolescod)
    {
        $sqlstr = "DELETE from `roles` where rolescod = :rolescod;";
        $sqlParams = array(
            "rolescod" => $rolescod
        );
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

}