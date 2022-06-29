<?php

    namespace Dao\Mnt;

    use Dao\Table;

    class Funciones extends Table 
    {

        /*
            CREATE TABLE `funciones` (
            `fncod` varchar(255) NOT NULL,
            `fndsc` varchar(45) DEFAULT NULL,
            `fnest` char(3) DEFAULT NULL,
            `fntyp` char(3) DEFAULT NULL,
            PRIMARY KEY (`fncod`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        */

        /**
         * Obtiene todos los registros de Funciones
         *
         * @return array
         */

        public static function getAll(){
            $sqlstr = "SELECT * from funciones;";
            return self::obtenerRegistros($sqlstr, array());
        }

        public static function getById(string $fncod){
            $sqlstr = "SELECT * from `funciones` where fncod=:fncod;";
            $sqlParams = array("fncod" => $fncod);
            return self::obtenerUnRegistro($sqlstr, $sqlParams);
        }

        public static function insert(
            $fncod,
            $fndsc,
            $fnest,
            $fntyp
        ) {
            $sqlstr = "INSERT INTO `funciones`
            (`fncod`,
            `fndsc`,
            `fnest`,
            `fntyp`)
            VALUES
            (:fncod,
            :fndsc,
            :fnest,
            :fntyp);";
    
            $sqlParams = [
                "fncod" => $fncod ,
                "fndsc" => $fndsc ,
                "fnest" => $fnest ,
                "fntyp" => $fntyp
            ];
            return self::executeNonQuery($sqlstr, $sqlParams);
        }
    public static function update(
        $fndsc,
        $fnest,
        $fntyp,
        $fncod
    ) {
        $sqlstr = "UPDATE `funciones`
        SET
        `fncod` = :fncod,
        `fndsc` = :fndsc,
        `fnest` = :fnest,
        `fntyp` = :fntyp
        WHERE `fncod` = :fncod;
        ";
        $sqlParams = array(
            "fndsc" => $fndsc ,
            "fnest" => $fnest ,
            "fntyp" => $fntyp ,
            "fncod" => $fncod
        );
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    public static function delete($fncod)
    {
        $sqlstr = "DELETE from `funciones` where fncod = :fncod;";
        $sqlParams = array(
            "fncod" => $fncod
        );
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    }

?>