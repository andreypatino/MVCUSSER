<?php

/**
 *	Clase con métodos relacionados con las operaciones en base de datos
 */
class DataBase {
	/**
	 *	Método que establece conexión con la base de datos
	 *	@return $cnxConexion Conexión con la base de datos
	 */
	function cnxConectar() {
		try
		{
			
			//PRODUCCION EMCALI DOS
			$strServidor  = "127.0.0.1";
			$strUsuario   = "root";
			$strClave     = "";
			$strBaseDatos = "pruebaus";

			//	Establecer conexión con la base de datos
			//$cnxConexion = mysqli_connect($strServidor, $strUsuario, $strClave, $strBaseDatos);
			$cnxConexion = new mysqli($strServidor, $strUsuario, $strClave, $strBaseDatos);

			//	Fijar charset
			mysqli_set_charset($cnxConexion, "utf8");

			//	Validar errores en la conexión
			if ($cnxConexion->connect_error) {
				throw new Exception("No se pudo establecer conexion");
			}

			//	Retornar conexión
			return $cnxConexion;
		}
		 catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}

	/**
	 *	Método que finaliza la conexión con la base de datos
	 *	@param $cnxConexion Objeto de conexión
	 */
	function desconectar($cnxConexion) {
		try
		{
			//	Fializar conexión indicada
			//mysqli_close($cnxConexion);
			$cnxConexion->close();
		}
		 catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}

	/**
	 *	Ejecutar sentencia de consulta
	 *	@param $strSentencia Sentencia SQL de consulta que se va a ejecutar
	 *	@return Arreglo con el conjunto de resultados
	 */
	function arrEjecutarConsulta($strSentencia) {
		try
		{
			//	Establecer conexión con la base de datos
			$cnxConexion = self::cnxConectar();

			//	Ejecutar consulta
			//$rslConsulta = mysqli_query($cnxConexion, $strSentencia);
			$rslConsulta =$cnxConexion->query($strSentencia);

			//	Finalizar la conextión con la base de datos
			self::desconectar($cnxConexion);

			//	Arreglo de filas para almacenar el resultado
			$arrFilas = null;

			//	Recorrer conjunto de resultados
			/*while ($drFila = mysqli_fetch_array($rslConsulta, MYSQL_ASSOC)) {
				$arrFilas[] = $drFila;//	Agregar fila al arreglo de resultados
			}*/
			while ($drFila = $rslConsulta->fetch_array(MYSQLI_ASSOC)) {
				$arrFilas[] = $drFila;//	Agregar fila al arreglo de resultados
			}
			//	Liberar conjunto de resultados
				//mysqli_free_result($rslConsulta);
				$rslConsulta->free();

			//	Retornar resultado de la consulta
			return $arrFilas;
		}
		 catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}

	/**
	 *	Método que ejecuta sentencias de inserción, modificación y eliminación en la base de datos
	 *	@param $strSentencia Sentencia SQL que se va a ejecutar
	 */
	function ejecutarSentencia($strSentencia, &$intCodigo = -1) {
		try
		{
			//	Establecer conexión con la base de datos
			$cnxConexion = self::cnxConectar();

			//	Ejecutar consulta
			//mysqli_query($cnxConexion, $strSentencia);
			$cnxConexion->query($strSentencia);

			//SABER CUANTAS FILAS AFECTO 
			$intAfectados=$cnxConexion->affected_rows;		
			//	Obtener último código insertado
			//$intCodigo = mysqli_insert_id($cnxConexion);
			$intCodigo =$cnxConexion->insert_id;
			
			//	Finalizar la conextión con la base de datos
			self::desconectar($cnxConexion);

			return $intAfectados;
		}
		 catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}
}

?>