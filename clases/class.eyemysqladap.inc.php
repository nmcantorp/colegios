<?php
class EyeMySQLAdap
{

	private $host, $user, $pass, $db_name;


	private $link;


	private $result;


	const DATETIME = 'Y-m-d H:i:s';


	const DATE = 'Y-m-d';


	public function __construct($host, $user, $password, $db, $persistant = true, $connect_now = true)
	{
		$this->host = 'localhost'; // Host
		$this->user = 'sialen5_adminrh';	// User
		$this->pass = 'sialenplmnko0';	// Password
		$this->db_name = 'sialen5_rh';	// Database

		if ($connect_now)
			$this->connect($persistant);

		return;
	}


	public function __destruct()
	{
		$this->close();
	}


	public function connect($persist = true)
	{
		if ($persist)
			$link = mysql_pconnect($this->host, $this->user, $this->pass);
		else
			$link = mysql_connect($this->host, $this->user, $this->pass);

		if (!$link)
			trigger_error('No hay conexion con la base de datos.', E_USER_ERROR);

		if ($link)
		{
			$this->link = $link;
			if (mysql_select_db($this->db_name, $link))
				return true;
		}

		return false;
	}

	/**
	 * Consultar la base de datos
*
* @ Param string $ cadena de consulta consulta SQL
* @ Retorno de los recursos de MySQL conjunto de resultados
	 */
	public function query($query)
	{
		$result = mysql_query($query, $this->link);

		$this->result = $result;

		if ($result == false)
			trigger_error('Revise su consulta SQL query: "' . $this->error() . '"');

		return $this->result;
	}

	/**
	 * Actualizar la base de datos
*
* @ Param array $ array los valores en 3D de campos y valores que se actualizan
* @ Param cadena de la tabla $ tabla para actualizar
* @ Param string $ en caso de enfermedad
* @ Param string $ límite de condición límite
* @ Return valor booleano
	 */
	public function update(array $values, $table, $where = false, $limit = false)
	{
		if (count($values) < 0)
			return false;
			
		$fields = array();
		foreach($values as $field => $val)
			$fields[] = "`" . $field . "` = '" . $this->escapeString($val) . "'";

		$where = ($where) ? " WHERE " . $where : '';
		$limit = ($limit) ? " LIMIT " . $limit : '';

		if ($this->query("UPDATE `" . $table . "` SET " . implode($fields, ", ") . $where . $limit))
			return true;
		else
			return false;
	}

	/**
	 * Insert una nueva linea
	 *
	 * @param array $values 3D array of fields and values to be inserted
	 * @param string $table Table to insert
	 * @return boolean Result
	 */
	public function insert(array $values, $table)
	{
		if (count($values) < 0)
			return false;
		
		foreach($values as $field => $val)
			$values[$field] = $this->escapeString($val);

		if ($this->query("INSERT INTO `" . $table . "`(`" . implode(array_keys($values), "`, `") . "`) VALUES ('" . implode($values, "', '") . "')"))
			return true;
		else
			return false;
	}

	/**
	 * Select
	 *
	 * @param mixed $fields Array or string of fields to retrieve
	 * @param string $table Table to retrieve from
	 * @param string $where Where condition
	 * @param string $orderby Order by clause
	 * @param string $limit Limit condition
	 * @return array Array of rows
	 */
	public function select($fields, $table, $where = false, $orderby = false, $limit = false)
	{
		if (is_array($fields))
			$fields = "`" . implode($fields, "`, `") . "`";

		$orderby = ($orderby) ? " ORDER BY " . $orderby : '';
		$where = ($where) ? " WHERE " . $where : '';
		$limit = ($limit) ? " LIMIT " . $limit : '';

		$this->query("SELECT " . $fields . " FROM `" . $table . "`" . $where . $orderby . $limit);

		if ($this->countRows() > 0)
		{
			$rows = array();

			while ($r = $this->fetchAssoc())
				$rows[] = $r;

			return $rows;
		} else
			return false;
	}
	/**
	 * Selecccion una linea
	 *
	 * @param mixed $fields Array or string of fields to retrieve
	 * @param string $table Table to retrieve from
	 * @param string $where Where condition
	 * @param string $orderby Order by clause
	 * @return array Row values
	 */
	public function selectOne($fields, $table, $where = false, $orderby = false)
	{
		$result = $this->select($fields, $table, $where, $orderby, '1');

		return $result[0];
	}
	
	/**
	 * Seleccion de un valor de una linea
	 *
	 * @param mixed $field Name of field to retrieve
	 * @param string $table Table to retrieve from
	 * @param string $where Where condition
	 * @param string $orderby Order by clause
	 * @return array Field value
	 */
	public function selectOneValue($field, $table, $where = false, $orderby = false)
	{
		$result = $this->selectOne($field, $table, $where, $orderby);

		return $result[$field];
	}

	/**
	 * Eliminar filas
*
* @ Param string $ tabla para eliminar la tabla de
* @ Param string $ en caso de enfermedad
* @ Param string $ límite de condición límite
* @ Return valor booleano
	 */
	public function delete($table, $where = false, $limit = 1)
	{
		$where = ($where) ? " WHERE " . $where : '';
		$limit = ($limit) ? " LIMIT " . $limit : '';

		if ($this->query("DELETE FROM `" . $table . "`" . $where . $limit))
			return true;
		else
			return false;
	}

	/**
	 * Fetch resultados por asociacion en array
	 *
	 * @param mixed $query Select query or MySQL result
	 * @return array Row
	 */
	public function fetchAssoc($query = false)
	{
		$this->resCalc($query);
		return mysql_fetch_assoc($query);
	}

	/**
	 * Fetch resultados por enumeracion array
	 *
	 * @param mixed $query Select query or MySQL result
	 * @return array Row
	 */
	public function fetchRow($query = false)
	{
		$this->resCalc($query);
		return mysql_fetch_row($query);
	}

	/**
	 * Fetch una linea
	 *
	 * @param mixed $query Select query or MySQL result
	 * @return array
	 */
	public function fetchOne($query = false)
	{
		list($result) = $this->fetchRow($query);
		return $result;
	}

	/**
	 * Fetch un campo por un resultado
	 *
	 * @param mixed $query Select query or MySQL result
	 * @param int $offset Field offset
	 * @return string Field name
	 */
	public function fieldName($query = false, $offset)
	{
		$this->resCalc($query);
		return mysql_field_name($query, $offset);
	}

	/**
	 * Fetch todos los campos
	 *
	 * @param mixed $query Select query or MySQL result
	 * @return array Field names
	 */
	public function fieldNameArray($query = false)
	{
		$names = array();

    	$field = $this->countFields($query);

    	for ( $i = 0; $i < $field; $i++ )
			$names[] = $this->fieldName($query, $i);

		return $names;
	}

	/**
	 * Free resultado de memoria
	 *
	 * @return boolean
	 */
	public function freeResult()
	{
		return mysql_free_result($this->result);
	}

	/**
	 * Add caracteres para data
	 *
	 * @param string $str String to parse
	 * @return string
	 */
	public function escapeString($str)
	{
		return mysql_real_escape_string($str, $this->link);
	}

	/**
	 * Count numero de filas en un resultado
	 *
	 * @param mixed $result Select query or MySQL result
	 * @return int Number of rows
	 */
	public function countRows($result = false)
	{
		$this->resCalc($result);
		return (int) mysql_num_rows($result);
	}

	/**
	 * Count numero de campos en un result
	 *
	 * @param mixed $result Select query or MySQL result
	 * @return int Number of fields
	 */
	public function countFields($result = false)
	{
		$this->resCalc($result);
		return (int) mysql_num_fields($result);
	}

	/**
	 * Recoge el id del último registro insertado de la última consulta
*
* @ Return int Insertado en
	 */
	public function insertId()
	{
		return (int) mysql_insert_id($this->link);
	}

	/**
	 *Obtener el número de filas afectadas de la última consulta
*
* @ Int retorno de filas afectadas
	 */
	public function affectedRows()
	{
		return (int) mysql_affected_rows($this->link);
	}

	/**
	 * Error para la descripcion de query
	 *
	 * @return string
	 */
	public function error()
	{
		return mysql_error($this->link);
	}

	/**
	 * Volcado de información a la página de MySQL
*
* @ Return void
	 */
	public function dumpInfo()
	{
		echo mysql_info($this->link);
	}

	/**
	 * Close el link conexion
	 *
	 * @return boolean
	 */
	public function close()
	{
		return mysql_close($this->link);
	}

	/**
	 * Determine la data tipo de un query
	 *
	 * @param mixed $result Query string or MySQL result set
	 * @return void
	 */
	private function resCalc(&$result)
	{
		if ($result == false)
			$result = $this->result;
		else {
			if (gettype($result) != 'resource')
				$result = $this->query($result);
		}

		return;
	}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<meta http-equiv="Content-Type" content="text/html; charset=uft-8">
</head>
</html>
