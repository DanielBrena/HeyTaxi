<?php 


require_once ($_SERVER['DOCUMENT_ROOT']."/Heytaxi/core/DBAbstractModel.php");
class RankTaxi extends DBAbstractModel {
	private $rta_id;
	private $rta_positivo;
	private $rta_negativo;
	private $rta_mensaje;
	private $rta_taxi_fk;

	function __construct(){
		$this->db_name = "Heytaxi";
	}

	public function get($id = ''){
		if($id != ''){
			if(is_int($id)){

				$this->query = "
				SELECT * FROM rank_taxi WHERE rta = '$id'
				";
				$this->get_results_from_query();
				if(count($this->rows) == 1){
					 foreach ($this->rows[0] as $propiedad => $valor) {
							$this->$propiedad = $valor;
					}
					$this->mensaje = "Se encontro ranking";
				}else{
					$this->mensaje = "No se encontro ranking";
				}

			}else{
				$this->mensaje = "Error";
			}
			
		}else{
			$this->mensaje = "Error";
		}
	}

	public function set($array_data_solicitud = array()){
		/*foreach ($array_data_solicitud as $campo => $valor) {
			$$campo = $valor;
		}

		$this->query = "INSERT INTO rank_taxi 
		(rta_id,rta_positivo,rta_negativo,rta_mensaje,rta_taxi_fk)
		VALUES
		('$rta_id','$rta_positivo','$rta_negativo','$rta_mensaje','$rta_taxi_fk')
		";
		$this->execute_single_query();
		$this->mensaje = "Se creo una ranking";
		*/

	}

	public function edit($array_data_rank_taxi = array()){
		/*foreach ($array_data_rank_taxi as $campo => $valor) {
			$$campo = $valor;
		}
		$this->query = "UPDATE rank_taxi SET
		r = '$sol_longitud',sol_latitud = '$sol_latitud','$sol_destino'
		WHERE sol_id = '$sol_id'
		";
		$this->execute_single_query();
		$this->mensaje = "Se actualizo sitio";*/
	}

	public function delete($id = ''){
		if($id != ''){
			$this->query = "DELETE FROM rank_taxi WHERE rta_id = '$id'";
			$this->execute_single_query();
			$this->mensaje = "Se elimino ranking";
		}
	}

	public function mostrar(){
        $this->query = "SELECT * FROM rank_taxi";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function positivo($mensaje = '', $id =''){
    	/*$this->query = "UPDATE rank_taxi set rta_positivo = rta_positivo +1
    	 WHERE rta_id = '$id' ";
    	 $this->execute_single_query();
    	 $this->mensaje = "Se aumento";
    	 */
    	$this->get($id);
    	$pos = $this->getRta_positivo();
    	$pos++;

		$this->query = "INSERT INTO rank_taxi 
		(rta_id,rta_positivo,rta_negativo,rta_mensaje,rta_taxi_fk)
		VALUES
		('$rta_id','$pos','$rta_negativo','$rta_mensaje','$rta_taxi_fk')
		";
		$this->execute_single_query();
		$this->mensaje = "Se creo una ranking";
    }
    public function negativo($id = ''){
    	$this->query = "UPDATE rank_taxi set rta_negativo = rta_negativo - 1
    	WHERE rta_id = '$id' ";
    	$this->execute_single_query();
    	$this->mensaje = "Se disminuyo";
    }


	public function to_json(){
            return json_encode(array(
              'rta_id' => $this->rta_id,
              'rta_positivo' => $this->rta_positivo,
              'rta_negativo' => $this->rta_negativo,
              'rta_mensaje' => $this->rta_mensaje,
              'rta_taxi_fk' => $this->rta_taxi_fk
              ));
    }

    public function getRta_positivo(){
    	return $this->rta_positivo;
    }

    public function getRta_negativo(){
    	return $this->rta_negativo;
    }

	function __destruct(){
		unset($this);
	}
}
 ?>