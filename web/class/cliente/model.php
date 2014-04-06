<?php 
require_once ($_SERVER['DOCUMENT_ROOT']."/Heytaxi/core/DBAbstractModel.php");
class Cliente extends DBAbstractModel {

	private $cli_id;
	private $cli_usuario_fk;

	function __construct(){
		$this->db_name = "Heytaxi";
	}

	public function get($id = ''){
		if($id != ''){
			if(is_int($id)){

				$this->query = "
				SELECT * FROM cliente WHERE cli_id = '$id'
				";
				$this->get_results_from_query();
				if(count($this->rows) == 1){
					 foreach ($this->rows[0] as $propiedad => $valor) {
							$this->$propiedad = $valor;
					}
					$this->mensaje = "Se encontro cliente";
				}else{
					$this->mensaje = "No se encontro cliente";
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

		$this->query = "INSERT INTO cliente 
		(cli_id,cli_usuario_fk)
		VALUES
		('$cli_id','$cli_usuario_fk')
		";
		$this->execute_single_query();
		$this->mensaje = "Se creo un cliente";

	}

	public function edit($array_data_sitio = array()){
		/*foreach ($array_data_sitio as $campo => $valor) {
			$$campo = $valor;
		}
		$this->query = "UPDATE taxi SET
		tax_numero = '$tax_numero',tax_placa = '$tax_placa'
		WHERE tax_id = '$tax_id'
		";
		$this->execute_single_query();
		$this->mensaje = "Se actualizo sitio";*/
	}

	public function delete($id = ''){
		if($id != ''){
			$this->query = "DELETE FROM cliente WHERE cli_id = '$id'";
			$this->execute_single_query();
			$this->mensaje = "Se elimino cliente";
		}
	}

	public function mostrar(){
        $this->query = "SELECT * FROM cliente";
        $this->get_results_from_query();
        return $this->rows;
    }


	public function to_json(){
            return json_encode(array(
              'cli_id' => $this->tax_id,
              'cli_usuario_fk' => $this->cli_usuario_fk
              ));
          }

	function __destruct(){
		unset($this);
	}

}

 ?>