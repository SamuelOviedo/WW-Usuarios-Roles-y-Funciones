<?php

    namespace Dao\Mnt;

    use Dao\Table;

    class Scores extends Table 
    {

        /*
            `scoreid` BIGINT(18) NOT NULL AUTO_INCREMENT,
            `scoredsc` VARCHAR(128) NULL,
            `scoreauthor` VARCHAR(256) NULL,
            `scoregenre` VARCHAR(256) NULL,
            `scoreyear` INT NULL,
            `scoresales` INT NULL,
            `scoreprice` DECIMAL(13,2) NULL,
            `scoredocurl` VARCHAR(256) NULL,
            `scoreest` CHAR(3) NULL,
            PRIMARY KEY (`scoreid`));
        */

        /**
         * Obtiene todos los registros de Scores
         *
         * @return array
         */

        public static function getAll(){
            $sqlstr = "SELECT * from scores;";
            return self::obtenerRegistros($sqlstr, array());
        }

        public static function getById(int $scoreId){
            $sqlstr = "SELECT * from `scores` where scoreID=:scoreId;";
            $sqlParams = array("scoreId" => $scoreId);
            return self::obtenerUnRegistro($sqlstr, $sqlParams);
        }

        /**
         * Insert into Productos
         *
         * @param [type] $scoreid  description
         * @param [type] $scoredsc description
         * @param [type] $scoreauthor    description
         * @param [type] $scoregenre    description
         * @param [type] $scoreyear    description
         * @param [type] $scoresales  description
         * @param [type] $scoreprice description
         * @param [type] $scoredocurl    description
         * @param [type] $scoreest    description
         *
         * @return void
        */

        public static function insert(
            $scoredsc,
            $scoreauthor,
            $scoregenre,
            $scoreyear,
            $scoresales,
            $scoreprice,
            $scoredocurl,
            $scoreest
        ) {
            $sqlstr = "INSERT INTO `scores`
            (`scoredsc`,
            `scoreauthor`,
            `scoregenre`,
            `scoreyear`,
            `scoresales`,
            `scoreprice`,
            `scoredocurl`,
            `scoreest`)
            VALUES
            (:scoredsc,
            :scoreauthor,
            :scoregenre,
            :scoreyear,
            :scoresales,
            :scoreprice,
            :scoredocurl,
            :scoreest);";
    
            $sqlParams = [
                "scoredsc" => $scoredsc ,
                "scoreauthor" => $scoreauthor ,
                "scoregenre" => $scoregenre ,
                "scoreyear" => $scoreyear ,
                "scoresales" => $scoresales ,
                "scoreprice" => $scoreprice ,
                "scoredocurl" =>  $scoredocurl ,
                "scoreest" => $scoreest
            ];
            return self::executeNonQuery($sqlstr, $sqlParams);
        }

        /**
     * Update Scores
     *
     * @param [type] $scoreid  description
     * @param [type] $scoredsc description
     * @param [type] $scoreauthor    description
     * @param [type] $scoregenre    description
     * @param [type] $scoreyear    description
     * @param [type] $scoresales  description
     * @param [type] $scoreprice description
     * @param [type] $scoredocurl    description
     * @param [type] $scoreest    description
     *
     * @return void
     */
    public static function update(
        $scoredsc,
        $scoreauthor,
        $scoregenre,
        $scoreyear,
        $scoresales,
        $scoreprice,
        $scoredocurl,
        $scoreest,
        $scoreid
    ) {
        $sqlstr = "UPDATE `scores`
        SET
        `scoreid` = :scoreid,
        `scoredsc` = :scoredsc,
        `scoreauthor` = :scoreauthor,
        `scoregenre` = :scoregenre,
        `scoreyear` = :scoreyear,
        `scoresales` = :scoresales,
        `scoreprice` = :scoreprice,
        `scoredocurl` = :scoredocurl,
        `scoreest` = :scoreest
        WHERE `scoreid` = :scoreid;
        ";
        $sqlParams = array(
            "scoredsc" => $scoredsc ,
            "scoreauthor" => $scoreauthor ,
            "scoregenre" => $scoregenre ,
            "scoreyear" => $scoreyear ,
            "scoresales" => $scoresales ,
            "scoreprice" => $scoreprice ,
            "scoredocurl" =>  $scoredocurl ,
            "scoreest" => $scoreest,
            "scoreid" => $scoreid
        );
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    /**
     * Undocumented function
     *
     * @param [type] $scoreid description
     *
     * @return void
     */
    public static function delete($scoreid)
    {
        $sqlstr = "DELETE from `scores` where scoreid = :scoreid;";
        $sqlParams = array(
            "scoreid" => $scoreid
        );
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    }

?>