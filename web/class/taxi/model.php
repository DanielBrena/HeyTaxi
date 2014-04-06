<?php 


require_once ($_SERVER['DOCUMENT_ROOT']."/Heytaxi/core/DBAbstractModel.php");
class Taxi extends DBAbstractModel {
	private $tax_id;
	private $tax_numero;
	private $tax_placa;
	private $tax_usuario_fk;
	private $tax_sitio_fk;

	function __construct(){
		$this->db_name = "Heytaxi";
	}

	public function get($id = ''){
		if($id != ''){
			if(is_int($id)){

				$this->query = "
				SELECT * FROM taxi WHERE tax_id = '$id'
				";
				$this->get_results_from_query();
				if(count($this->rows) == 1){
					 foreach ($this->rows[0] as $propiedad => $valor) {
							$this->$propiedad = $valor;
					}
					$this->mensaje = "Se encontro taxi";
				}else{
					$this->mensaje = "No se encontro taxi";
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

		$this->query = "INSERT INTO taxi 
		(tax_id,tax_numero,tax_placa,tax_usuario_fk,tax_sitio_fk)
		VALUES
		('$tax_id','$tax_numero','$tax_placa','$tax_usuario_fk','$tax_sitio_fk')
		";
		$this->execute_single_query();
		$this->mensaje = "Se creo un taxi";

	}

	public function edit($array_data_sitio = array()){
		foreach ($array_data_sitio as $campo => $valor) {
			$$campo = $valor;
		}
		$this->query = "UPDATE taxi SET
		tax_numero = '$tax_numero',tax_placa = '$tax_placa'
		WHERE tax_id = '$tax_id'
		";
		$this->execute_single_query();
		$this->mensaje = "Se actualizo sitio";
	}

	public function delete($id = ''){
		if($id != ''){
			$this->query = "DELETE FROM taxi WHERE tax_id = '$id'";
			$this->execute_single_query();
			$this->mensaje = "Se elimino taxi";
		}
	}

	public function mostrar(){
        $this->query = "SELECT * FROM taxi";
        $this->get_results_from_query();
        return $this->rows;
    }


	public function to_json(){
            return json_encode(array(
              'tax_id' => $this->tax_id,
              'tax_numero' => $this->tax_numero,
              'tax_placa' => $this->tax_placa,
              'tax_usuario_fk' => $this->tax_usuario_fk,
              'tax_sitio_fk' => $this->tax_sitio_fk
              ));
          }

	function __destruct(){
		unset($this);
	}
}
 ?>