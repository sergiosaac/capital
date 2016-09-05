<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CRUD
 *
 * @author Exilon
 */
class CRUD {


    public $insertInto;
    public $insertColumns;
    public $insertValues;
    public $mensaje;
    public $select;
    public $from;
    public $condition;
    public $rows;
    public $update;
    public $set;
    public $deletefrom;
    //Nuevos
    public $orderBy;
    public $consultaPersonalizada;
    public $ultimoId;
  
  
  
  
     public function ConsultaPersonalizada() {

        $model = new Conexion;
        $conexion = $model->conectar();
        $sql = $this->consultaPersonalizada;
        
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        while ($filas = $consulta->fetch()) {
            $this->rows[] = $filas;
        }
    }
  
  

    public function Create() {

        $model = new Conexion;
        $conexion = $model->conectar();
        $insertInto = $this->insertInto;
        $insertColumns = $this->insertColumns;
        $insertValues = $this->insertValues;
        $sql = "INSERT INTO $insertInto ($insertColumns) VALUES ($insertValues)";
        $consulta = $conexion->prepare($sql);
        
        if (!$consulta) {

            $this->mensaje = "Error al crear registro";
        } else {
            $consulta->execute();
            $this->mensaje = "Registro creado correctamente";
            $this->ultimoId = $conexion->lastInsertId();
        }
    }
  
  


    public function Read() {

        $model = new Conexion;
        $conexion = $model->conectar();
        $select = $this->select;
        $from = $this->from;
        $orderBy = $this->orderBy;
        $condition = $this->condition;
        if ($condition != '') {
            $condition = 'WHERE ' . $condition;
        }

        $sql = "SELECT $select FROM $from $condition $orderBy";
        
        $consulta = $conexion->prepare($sql);
        $consulta->execute();

        while ($filas = $consulta->fetch()) {

            $this->rows[] = $filas;
        }



    }

    public function Update() {


        $model = new Conexion;
        $conexion = $model->conectar();
        $update = $this->update;
        $set = $this->set;
        $condition = $this->condition;
        if ($condition != '') {
            $condition = " WHERE " . $condition;
        }

        $sql = "UPDATE $update SET $set $condition";

        $consulta = $conexion->prepare($sql);

        if (!$consulta) {

            $this->mensaje = "Ha ocurrido un error al actualizar el registro";
        } else {

            $consulta->execute();
            $this->mensaje = "Actualizado correctamente";
        }
    }

    public function Delete() {


        $model = new Conexion;
        $conexion = $model->conectar();
        $deletefrom = $this->deletefrom;
        $condition = $this->condition;
        if ($condition != '') {
            $condition = "WHERE " . $condition;
        }

        $sql = "DELETE FROM $deletefrom $condition";                
        $consulta = $conexion->prepare($sql);
        if (!$consulta) {

            $this->mensaje = "Ha ocurrido un erro al eliminar";
        } else {

            $consulta->execute();

            $this->mensaje = "Eliminado correctamente";
        }
    }

}
