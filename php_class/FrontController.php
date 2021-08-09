<?php

session_start();
include_once('Libraries.php');
$rta = new StdClass();
try 
{
	switch ($_REQUEST['command']) 
	{
		
		case 'CRol':		
			$CRol = new usuarios();			
			$rta = $CRol->ConsultaRol();
			break;

		case 'GetUsuarios':	
			$GetUsuarios = new usuarios();
			$rta = $GetUsuarios->CreateUser($_REQUEST['nombre'], $_REQUEST['tipoRol'], $_REQUEST['estado']);

		case 'SetUsuarios':				
			$SetUsuarios = new usuarios();
			$rta = $SetUsuarios->UpdateUser($_REQUEST['idusser'],$_REQUEST['nombre'], $_REQUEST['tipoRol'], $_REQUEST['estado']);

		case 'EUsuario':
		    $EUsuario = new usuarios();
			$rta = $EUsuario->DeleteteUser($_REQUEST['usser']);	

		case 'CUsuarios':						
			$CUsuarios = new usuarios();
			$rta = $CUsuarios->ConsultaUsuarios();
			break;
					
		default:
			echo "No existe command.";
			break;
	}	
} 
catch (Exception $e) 
{
	$rta->tipo = 'error';
	$rta->mensaje = $e->getMessage();
}

ob_clean();
echo json_encode($rta);