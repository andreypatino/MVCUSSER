<?php
class usuarios
{
    public function __construct() 
	{	
		require_once ("Db.php");
		$this->obClsDB = new DataBase();
	}
	
	
	function CreateUser($nombre, $tipoRol, $estado)
	{
		
		try
		{
			$rta  = "INSERT INTO `usuario`(`FK_idRol`, `nombreUsuario`, `activo`) VALUES  ('".$tipoRol."','".$nombre."','".$estado."');";
    		
    		$queryselect = $this->obClsDB->ejecutarSentencia($rta);
    		if (empty($queryselect)) {               
                throw new Exception('no se pudo registrar el producto');
            }else{
            	$rta = new StdClass();
            	$rta->tipo = 'exito';
				$rta->mess = 'Se registro el producto con exito.';			
            }       	
			return $rta;
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	function ConsultaUsuarios()
	{
		
			$rta1 = new StdClass();
			$rta  = "SELECT a.idUsuario, a.nombreUsuario, b.idRol, b.nombreRol, case a.activo when 1 then 'Activo' when 2 then 'Desactivado' end as status FROM usuario a INNER JOIN rol b ON b.idRol = a.FK_idRol;";    		
    		$queryselect = $this->obClsDB->arrEjecutarConsulta($rta);
    		if (empty($queryselect)) {               
               	$rta1->tipo = 'error';
				$rta1->mess = 'Error en la consulta de la informacion.';
            }else{            	
            	$rta1->tipo = 'exito';
				$rta1->mess = 'Se registro el producto con exito.';	
               	$rta1->data = $queryselect;	              
			}
			return $rta1;
	}
	function ConsultaRol()
	{
		
			$rta1 = new StdClass();
			$rta  = "SELECT * FROM `rol`;";    		
    		$queryselect = $this->obClsDB->arrEjecutarConsulta($rta);
    		if (empty($queryselect)) {               
               	$rta1->tipo = 'error';
				$rta1->mess = 'Error en la consulta de la informacion.';
            }else{            	
            	$rta1->tipo = 'exito';
				$rta1->mess = 'Se registro el producto con exito.';	
               	$rta1->data = $queryselect;	              
			}
			return $rta1;
	}

	function DeleteteUser($usuario)
	{		
		try
		{
			$rta  = "DELETE FROM usuario WHERE idUsuario = ".$usuario.";";    		
    		$queryselect = $this->obClsDB->ejecutarSentencia($rta);
    		if (empty($queryselect)) {               
                throw new Exception('no se pudo eliminar el producto');
            }else{
            	$rta = new StdClass();
            	$rta->tipo = 'exito';
				$rta->mess = 'Se elimino el producto con exito.';			
            }       	
			return $rta;
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}

	}


	function UpdateUser($idusser, $nombre, $tipoRol, $estado)
	{		
		try
		{
			$rta  = "UPDATE `usuario` SET `FK_idRol`=".$tipoRol.",`nombreUsuario`='".$nombre."',`activo`=".$estado." WHERE idUsuario = ".$idusser.";";    		
    		$queryselect = $this->obClsDB->ejecutarSentencia($rta);
    		if (empty($queryselect)) {               
                throw new Exception('no se pudo actualizar');
            }else{
            	$rta = new StdClass();
            	$rta->tipo = 'exito';
				$rta->mess = 'Se actualizo con exito.';			
            }       	
			return $rta;
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}

	}
}