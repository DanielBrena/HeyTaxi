<?php 


require_once ($_SERVER['DOCUMENT_ROOT']."/Heytaxi/core/DBAbstractModel.php");
class Sitio extends DBAbstractModel {
	private $sit_id;
	private $sit_nombre;
	private $sit_clave;
	private $sit_latitud;
	private $sit_longitud;
	private $sit_ubicacion;
	private $sit_numeroCajones;
	private $sit_usuario_fk;


	function __construct(){
		$this->db_name = "Heytaxi";
	}

	public function get($id = ''){
		if($id != ''){
			if(is_int($id)){

				$this->query = "
				SELECT * FROM sitio WHERE sit_id = '$id'
				";
				$this->get_results_from_query();
				if(count($this->rows) == 1){
					 foreach ($this->rows[0] as $propiedad => $valor) {
							$this->$propiedad = $valor;
					}
					$this->mensaje = "Se encontro sitio";
				}else{
					$this->mensaje = "No se encontro sitio";
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

		$this->query = "INSERT INTO sitio 
		(sit_id,sit_nombre,sit_clave,sit_latitud,sit_longitud,sit_ubicacion,sit_numeroCajones,sit_usuario_fk)
		VALUES
		('$sit_id','$sit_nombre','$sit_clave','$sit_latitud','$sit_longitud','$sit_ubicacion','$sit_numeroCajones','$sit_usuario_fk')
		";
		$this->execute_single_query();
		$this->mensaje = "Se creo un sitio";

	}

	public function edit($array_data_sitio = array()){
		foreach ($array_data_sitio as $campo => $valor) {
			$$campo = $valor;
		}
		$this->query = "UPDATE sitio SET
		sit_nombre = '$sit_nombre',sit_clave = '$sit_clave',
		sit_latitud = '$sit_latitud',sit_longitud = '$sit_longitud',sit_ubicacion='$sit_ubicacion',sit_numeroCajones = '$sit_longitud'
		WHERE sit_id = '$sit_id'
		";
		$this->execute_single_query();
		$this->mensaje = "Se creo un sitio";
	}

	public function delete($id = ''){
		if($id != ''){
			$this->query = "DELETE FROM sitio WHERE sit_id = '$id'";
			$this->execute_single_query();
			$this->mensaje = "Se elimino sitio";
		}
	}

	public function mostrar(){
        $this->query = "SELECT * FROM sitio";
        $this->get_results_from_query();
        return $this->rows;
    }


	public function to_json(){
            return json_encode(array(
              'sit_id' => $this->sit_id,
              'sit_nombre' => $this->sit_nombre,
              'sit_clave' => $this->sit_clave,
              'sit_latitud' => $this->sit_latitud,
              'sit_longitud' => $this->sit_longitud,
              'sit_ubicacion' => $this->sit_ubicacion,
              'sit_numeroCajones' => $this->sit_numeroCajones,
              'sit_usuario_fk' =>  $this->sit_usuario_fk
              ));
          }

	function __destruct(){
		unset($this);
	}
}
 ?>