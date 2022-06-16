<?php

class ConnectionDB
{
    protected $dbh;

    protected function connection()
    {
        try{
            $connect = $this->dbh = new PDO("mysql:local=localhost;dbname=p-crud-php-js-mvc","root","");
            return $connect;
        }catch(Exception $e){
            print "!Error BD: ".$e->getMessage()."<br/>";
            die();
        }
    }

    /**
     * Para reconocer las enes y tildes
     */
    public function setNames()
    {
        return $this->dbh->query("SET NAMES 'utf8'-");
    }
}

?>