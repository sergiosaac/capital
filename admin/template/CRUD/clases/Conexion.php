<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Conexion
 *
 * @author Exilon
 */
class Conexion {
	/*
    public function conectar() {

        $usuario = 'capitaco_carlos';
        $contrasena = 'capital246';
        $host = 'localhost';
        $dbname = 'capitaco_capital_db';
        $con = new PDO("mysql:host=$host;dbname=$dbname", $usuario, $contrasena, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
      
      return $con;
      
    
    }*/

    public function conectar() {

        $usuario = 'root';
        $contrasena = 'root';
        $host = 'localhost';
        $dbname = 'capitaco_capital_db';
        $con = new PDO("mysql:host=$host;dbname=$dbname", $usuario, $contrasena, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
      
      return $con;
      
    
    }
}
