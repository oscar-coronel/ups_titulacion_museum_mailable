<?php

class Conn
{
	private $oConn;

	private $HOST = 'localhost';
	private $PORT = 3306;
	private $DB_NAME = 'museum_2';
	private $USERNAME = 'root';
	private $PASSWORD = '';

	private function connect()
	{
		$this->oConn = new PDO("mysql:host=$this->HOST;port=$this->PORT;dbname=$this->DB_NAME;charset=utf8", $this->USERNAME, $this->PASSWORD);
	}

	private function close()
	{
		$this->oConn = null;
	}

	protected function transaction($callback)
	{
		$this->connect();
		$oResult = $callback($this->oConn);
		$this->close();
		return $oResult;
	}

}

?>