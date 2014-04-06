<?php 


require_once ($_SERVER['DOCUMENT_ROOT']."/Heytaxi/core/DBAbstractModel.php");
class NotificacionTaxi extends DBAbstractModel {
	private $nta_id;
	private $nta_destino;
	private $nta_costo;
	private $nta_tiempo;
	private $nta_taxi_fk;
	private $nta_cliente_fk;

	function __construct(){
		$this->db_name = "Heytaxi";
	}

	public function get($id = ''){
		if($id != ''){
			if(is_int($id)){

				$this->query = "
				SELECT * FROM notificacion_taxi WHERE nta_id = '$id'
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

		$this->query = "INSERT INTO notificacion_taxi 
		(nta_id,nta_destino,nta_costo,nta_tiempo,nta_taxi_fk,nta_cliente_fk)
		VALUES
		('$nta_id','$nta_destino','$nta_costo','$nta_taxi_fk','$nta_cliente_fk')
		";
		$this->execute_single_query();
		$this->mensaje = "Se creo un taxi";

	}

	public function edit($array_data_sitio = array()){
		foreach ($array_data_sitio as $campo => $valor) {
			$$campo = $valor;
		}
		$this->query = "UPDATE notificacion_taxi SET
		nta_destino = '$nta_destino',nta_costo = '$nta_costo'
		WHERE nta_id = '$nta_id'
		";
		$this->execute_single_query();
		$this->mensaje = "Se actualizo sitio";
	}

	public function delete($id = ''){
		if($id != ''){
			$this->query = "DELETE FROM notificacion_taxi WHERE nta_id = '$id'";
			$this->execute_single_query();
			$this->mensaje = "Se elimino notificacion";
		}
	}

	public function mostrar(){
        $this->query = "SELECT * FROM notificacion_taxi";
        $this->get_results_from_query();
        return $this->rows;
    }


	public function to_json(){
            return json_encode(array(
              'nta_id' => $this->nta_id,
              'nta_destino' => $this->nta_destino,
              'nta_costo' => $this->nta_costo,
              'nta_taxi_fk' => $this->nta_taxi_fk,
              'nta_cliente_fk' => $this->nta_cliente_fk
              ));
          }

	function __destruct(){
		unset($this);
	}
}
 ?>