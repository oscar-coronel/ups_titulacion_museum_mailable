<?php

require_once __DIR__.'/Conn.php';

class Transaction extends Conn
{

	protected $table = null;

	public function get()
	{
		$oResult = $this->transaction(function($oConn){
			if( $this->table == null ) return null;
			$stmt = $oConn->prepare("SELECT * FROM $this->table");
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		});
		return $oResult;
	}

}


?>