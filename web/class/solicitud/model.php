<?php 


require_once ($_SERVER['DOCUMENT_ROOT']."/Heytaxi/core/DBAbstractModel.php");
class Solicitud extends DBAbstractModel {
	private $sol_id;
	private $sol_longitud;
	private $sol_latitud;
	private $sol_destino;
	private $sol_cliente_fk;
	private $sol_sitio_fk;

	function __construct(){
		$this->db_name = "Heytaxi";
	}

	public function get($id = ''){
		if($id != ''){
			if(is_int($id)){

				$this->query = "
				SELECT * FROM solicitud WHERE sol_id = '$id'
				";
				$this->get_results_from_query();
				if(count($this->rows) == 1){
					 foreach ($this->rows[0] as $propiedad => $valor) {
							$this->$propiedad = $valor;
					}
					$this->mensaje = "Se encontro solicitud";
				}else{
					$this->mensaje = "No se encontro solicitud";
				}

			}else{
				$this->mensaje = "Error";
			}
			
		}else{
			$this->mensaje = "Error";
		}
	}

	public function set($array_data_solicitud = array()){
		foreach ($array_data_solicitud as $campo => $valor) {
			$$campo = $valor;
		}

		$this->query = "INSERT INTO solicitud 
		(sol_id,sol_longitud,sol_latitud,sol_destino,sol_cliente_fk,sol_sitio_fk)
		VALUES
		('$sol_id','$sol_longitud','$sol_latitud','$sol_destino','$sol_cliente_fk','$sol_sitio_fk')
		";
		$this->execute_single_query();
		$this->mensaje = "Se creo una solicitud";

	}

	public function edit($array_data_solicitud = array()){
		foreach ($array_data_solicitud as $campo => $valor) {
			$$campo = $valor;
		}
		$this->query = "UPDATE solicitud SET
		sol_longitud = '$sol_longitud',sol_latitud = '$sol_latitud','$sol_destino'
		WHERE sol_id = '$sol_id'
		";
		$this->execute_single_query();
		$this->mensaje = "Se actualizo sitio";
	}

	public function delete($id = ''){
		if($id != ''){
			$this->query = "DELETE FROM solicitud WHERE sol_id = '$id'";
			$this->execute_single_query();
			$this->mensaje = "Se elimino solicitud";
		}
	}

	public function mostrar(){
        $this->query = "SELECT * FROM solicitud";
        $this->get_results_from_query();
        return $this->rows;
    }


	public function to_json(){
            return json_encode(array(
              'sol_id' => $this->sol_id,
              'sol_longitud' => $this->sol_longitud,
              'sol_latitud' => $this->sol_latitud,
              'sol_destino' => $this->sol_destino,
              'sol_cliente_fk' => $this->sol_cliente_fk,
              'sol_sitio_fk' => $this->sol_sitio_fk
              ));
          }

	function __destruct(){
		unset($this);
	}
}
 ?>