<?php

/**
  @autor Daniel Brena Aquino.

 */
abstract class DBAbstractModel {

          private static $db_host = "localhost";
          private static $db_user = "root";
          private static $db_password = "danielbrena2";
          protected $db_name = "heytaxi";
          protected $query;
          protected $rows = array();
          private $conexion;
          public $mensaje = "Hecho";
          
          /**
           * Metodo abstracto que nos trae los resultados de una peticion, asi como tambien
           * nos ayudara a verificar si un valor se encuentra dentro de la base de datos.
           */
          abstract protected function get();
          /**
           * Metodo abstracto que insertara datos a la base de datos.
           */
          abstract protected function set();
          /**
           * Metodo abstracto que actualizara cualquier dato dentro de la tabla.
           */
          abstract protected function edit();
          /**
           * Metodo abstracto para eliminar un dato en concreto de la  base de datos.
           */
          abstract protected function delete();

         /**
          * Contructor de la clase, usa las propiedad estaticas para abrir la conexion a la 
          * base de datos.
          */
          public function open_connection() {
                    $this->conexion = new mysqli(self::$db_host, self::$db_user, self::$db_password, $this->db_name);
          }

          /**
           *
           * Funcion para cerrar la conexion de nuestra base de datos.
           */
          public function close_connection() {
                    $this->conexion->close();
          }

          /**
           * 
           * Funcion que nos permite hacer las peticiones sql.
           */
          protected function execute_single_query() {
                    $this->open_connection();
                    $this->conexion->query($this->query);
                    $this->close_connection();
          }

          /**
            Funcion que hace una peticion y nos arroja un resultado que lo almacena en un
            arreglo llamado rows que podra ser accedido.

           */
          protected function get_results_from_query() {
                    $this->open_connection();
                    $result = $this->conexion->query($this->query);
                    while ($this->rows[] = $result->fetch_assoc());
                    $result->close();
                    $this->close_connection();
                    array_pop($this->rows);
          }

}

?>