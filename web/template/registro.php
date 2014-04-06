<?php 

require_once("../class/usuario/model.php");
$usuario_data = new Usuario();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	@$action = $_POST['action'];
	@$nombre = $_POST['nombre'];
	@$apellidoPaterno = $_POST['apellidoP'];
	@$apellidoMaterno = $_POST['apellidoM'];
	@$correo = $_POST['correo'];
	@$clave = $_POST['clave'];
	@$usuario = $_POST['usuario'];

	@$i_usuario = $_POST['i_usuario'];
	@$i_clave = $_POST['i_clave'];

	$array_data_usuario = array(
	'usu_id' => '',
	'usu_nombre' => $nombre,
	'usu_apellidoPaterno' => $apellidoPaterno,
	'usu_apellidoMaterno' => $apellidoMaterno,
	'usu_correo' => $correo,
	'usu_clave' => $clave,
	'usu_tipo' => 'Usuario',
	'usu_usuario' => $usuario,
);


	switch($action){
		case 'Crear':
	    $usuario_data->set($array_data_usuario);
		$json = json_encode($usuario_data);
		echo $json;
		break;

		case 'Iniciar':
	    $usuario_data->login($i_usuario,$i_clave);
		$json = json_encode($usuario_data);
		echo $json;
		break;
	}
}
 ?>