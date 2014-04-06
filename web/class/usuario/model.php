<?php


/**
 * Description of model
 *
 * @author daniel
 * 
 */

require_once ($_SERVER['DOCUMENT_ROOT']."/Heytaxi/core/DBAbstractModel.php");
class Usuario extends DBAbstractModel {
          private  $usu_id;
          private $usu_nombre;
          private $usu_apellidoPaterno;
          private $usu_apellidoMaterno;
          private $usu_correo;
          private $usu_clave;
          private $usu_usuario;
          private $usu_tipo;
          
          function __construct() {
                    $this->db_name  = "heytaxi";
          }
          public function get($id = ''){
                    if($id != ''){
                              
                              if(is_int($id)){
                                        
                                        $this->query = "
                                                  SELECT * FROM usuario 
                                                  WHERE usu_id = '$id'
                                         ";
                                        
                              }else{
                                        
                                        $this->query = "
                                                  SELECT * FROM usuario
                                                  WHERE usu_correo = '$id' OR usu_usuario = '$id'
                                        ";
                               }
                              $this->get_results_from_query();
                              
                              if(count($this->rows) == 1){
                                        foreach ($this->rows[0] as $propiedad => $valor) {
                                                  $this->$propiedad = $valor;
                                        }
                                      
                                        $this->mensaje = "Se encontro usuario";
                                        
                              }else{
                                        $this->mensaje = "No se encontro usuario";
                              }
                                        
                                        
                    }else{
                              $this->mensaje = "Error";
                    }
          }
          
          public function set($array_data = array()){
                 

            foreach ($array_data as $campo => $valor) {
                $$campo = $valor;
                echo $campo. " ".$valor;
            }

            
            if($usu_nombre != ''  && $usu_apellidoPaterno != '' &&  ($usu_correo != '' && filter_var($usu_correo, FILTER_VALIDATE_EMAIL)) && $usu_usuario != '' && $usu_clave != ''){
               
               $usu_clave = base64_encode($usu_clave);
             
               $this->query = "
                  INSERT INTO usuario
                  (usu_id,usu_nombre,usu_apellidoPaterno,usu_apellidoMaterno,
                  usu_correo,usu_clave,usu_tipo,usu_usuario)
                  VALUES
                  ('$usu_id','$usu_nombre','$usu_apellidoPaterno','$usu_apellidoMaterno',
                  '$usu_correo','$usu_clave','$usu_tipo','$usu_usuario')
                  ";
                  $this->execute_single_query();
                  $this->mensaje = "Se ha creado un usuario";
                  //return 
                   
            }else{
              $this->mensaje = "Error, faltaron algunos datos";
            }
                           
          }


          
          public function edit($array_data = array()){
                    if(array_key_exists('usu_id', $array_data)){
                              foreach ($array_data as $campo => $valor) {
                                        $$campo = $valor;
                              }
                              if($usu_nombre != ''  && $usu_apellidoPaterno != '' &&  ($usu_correo != '' && filter_var($usu_correo, FILTER_VALIDATE_EMAIL)) && $usu_usuario != '' && $usu_clave != ''){
                                    $usu_clave = base64_encode($usu_clave);

                                  $this->query = "
                                          UPDATE usuario
                                          SET
                                          usu_nombre = '$usu_nombre',
                                                    usu_apellidoPaterno = '$usu_apellidoPaterno',
                                                              usu_apellidoMaterno = '$usu_apellidoMaterno',
                                                                        usu_correo = '$usu_correo',
                                                                                  usu_usuario = '$usu_usuario',
                                                                                            usu_clave = '$usu_clave'
                                                                                                      
                                                                                                                
                                                                                                      WHERE usu_id ='$usu_id'
                                                                                  
                                  ";
                                $this->execute_single_query();
                                $this->mensaje = "Se actualizo usuario";
                              }else{
                                $this->mensaje =  "Error, faltaron algunos campos obligatorios que rellenar.";
                              }
                              
                    }else{
                              $this->mensaje = "Error";
                    }
                    
          }
          
         
          public function delete($id =''){
                    if($id != ''){
                              $this->query = "DELETE FROM usuario 
                                        WHERE usu_id = '$id'";
                              $this->execute_single_query();
                              $this->mensaje = "Administrador eliminado";
                              
                    }else{
                              $this->mensaje = "Error";
                    }
          }

          public function login($admin = '',$clave = ''){
            if($admin != '' && $clave != ''){
              $clave = base64_encode($clave);
              $this->query = "SELECT * FROM usuario
              WHERE usu_correo = '$admin' OR usu_usuario = '$admin' AND usu_clave = '$clave'";
              $this->get_results_from_query();

              if(count($this->rows) == 1){
                foreach ($this->rows[0] as $propiedad => $valor) {
                  $this->$propiedad = $valor;
                }
                $this->mensaje = "Se econtro";
                return $this->getUsu_id();
              }else{
                $this->mensahe = "No se encontro";
                return false;
              }
            }else{
              $this->mensaje = "Error";
              return "Error";
            }
            
          }

          /*public function validar_tiempo_real($adm_nombre ='',$adm_usuario ='',$adm_apellidoPaterno = '',$adm_correo = ''){
            $this->query = "SELECT * FROM sb_administrador
                                           WHERE adm_nombre = '$adm_nombre' AND adm_apellidoPaterno = '$adm_apellidoPaterno'
                                                     OR adm_correo = '$adm_correo' OR adm_usuario = '$adm_usuario'                                               
                                        ";
                                 $this->get_results_from_query();
                                 
                                 if(count($this->rows) == 1){
                                           $this->mensaje = "Administrador existente, puede que el Nombre, Usuario o Correo ya estan en uso.";
                                           return true;
                                 }else{
                                    $this->mensaje = "undefined";
                                    return false;
                                 }
                                 
          }
          */
          public function mostrar(){
            $this->query = "SELECT * FROM usuario";
            $this->get_results_from_query();
            return $this->rows;
          }

          /*public function changeStatus($id = '', $opcion = ''){
            
              if(is_int($id)){
                if($opcion == 1){
                  $this->query = "UPDATE sb_administrador SET adm_estado = '1' WHERE adm_id = '$id'";
                  $this->execute_single_query();
                  $this->mensaje = "Administrador activo";
                }else{
                  $this->query = "UPDATE sb_administrador SET adm_estado = '0' WHERE adm_id = '$id'";
                  $this->execute_single_query();
                  $this->mensaje = "Administrador activo";
                }
              }else{
                $this->mensaje = "Error";
              }
            
          }*/

          public function to_json(){
            return json_encode(array(
              'usu_id' => $this->usu_id,
              'usu_nombre' => $this->usu_nombre,
              'usu_apellidoPaterno' => $this->usu_apellidoPaterno,
              'usu_apellidoMaterno' => $this->usu_apellidoMaterno,
              'usu_correo' => $this->usu_correo,
              'usu_usuario' => $this->usu_usuario,
              'usu_clave' =>  base64_decode($this->usu_clave),
              'usu_tipo' => $this->usu_tipo
              ));
          }
          
          public function getUsu_id() {
                    return $this->usu_id;
          }

          public function getUsu_nombre() {
                    return $this->usu_nombre;
          }

          public function getUsu_apellidoPaterno() {
                    return $this->usu_apellidoPaterno;
          }

          public function getUsu_apellidoMaterno() {
                    return $this->usu_apellidoMaterno;
          }

          public function getUsu_correo() {
                    return $this->usu_correo;
          }

          public function getUsu_usuario() {
                    return $this->usu_usuario;
          }

          public function getUsu_clave() {
                    return $this->usu_clave;
          }

          public function getUsu_tipo() {
                    return $this->usu_tipo;
          }

         

          function __destruct() {
                    unset($this);
          }
          
          
          
}

?>
