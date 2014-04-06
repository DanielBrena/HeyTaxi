<?php 


require_once ($_SERVER['DOCUMENT_ROOT']."/Heytaxi/core/DBAbstractModel.php");
class NotificacionUsuario extends DBAbstractModel {
	private $nus_id;
	private $nus_costo;
	private $nus_taxi_fk;
	private $nus_cliente_fk;

	function __construct(){
		$this->db_name = "Heytaxi";
	}

	public function get($id = ''){
		if($id != ''){
			if(is_int($id)){

				$this->query = "
				SELECT * FROM notificacion_usuario WHERE nus_id = '$id'
				";
				$this->get_results_from_query();
				if(count($this->rows) == 1){
					 foreach ($this->rows[0] as $propiedad => $valor) {
							$this->$propiedad = $valor;
					}
					$this->mensaje = "Se encontro notificacion";
				}else{
					$this->mensaje = "No se encontro notificacion";
				}

			}else{
				$this->mensaje = "Error";
			}
			
		}else{
			$this->mensaje = "Error";
		}
	}

	public function set($array_data_sitio = array()){
		foreach ($array_data_sitio as $campo => $valor) {
			$$campo = $valor;
		}

		$this->query = "INSERT INTO notificacion_usuario 
		(nus_id,nus_costo,nus_taxi_fk,nus_cliente_fk)
		VALUES
		('$nus_id','$nus_costo','$nus_taxi_fk','$nus_cliente_fk')
		";
		$this->execute_single_query();
		$this->mensaje = "Se creo una notificacion";

	}

	public function edit($array_data_sitio = array()){
		foreach ($array_data_sitio as $campo => $valor) {
			$$campo = $valor;
		}
		$this->query = "UPDATE notificacion_usuario SET
		nus_costo = '$nus_costo'
		WHERE nus_id = '$nus_id'
		";
		$this->execute_single_query();
		$this->mensaje = "Se actualizo notificacion";
	}

	public function delete($id = ''){
		if($id != ''){
			$this->query = "DELETE FROM notificacion_usuario WHERE nus_id = '$id'";
			$this->execute_single_query();
			$this->mensaje = "Se elimino notificacion";
		}
	}

	public function mostrar(){
        $this->query = "SELECT * FROM notificacion_usuario";
        $this->get_results_from_query();
        return $this->rows;
    }


	public function to_json(){
            return json_encode(array(
              'nus_id' => $this->nus_id,
              'nus_costo' => $this->nus_costo,
              'nus_taxi_fk' => $this->nus_taxi_fk,
              'nus_cliente_fk' => $this->nus_cliente_fk
              ));
          }

	function __destruct(){
		unset($this);
	}
}
 ?>