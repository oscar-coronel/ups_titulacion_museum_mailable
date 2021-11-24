<?php

require_once __DIR__.'/../database/Transaction.php';

class Information extends Transaction
{

	protected $table = 'informations';

	public function getAllInfo()
	{
		$data = $this->get();
		foreach ($data as $index => $row) {
			$places = $this->transaction(function($oConn) use ($row){
				$stmt = $oConn->prepare("SELECT * FROM places WHERE information_id = ?");
				$stmt->bindValue(1, $row['id']);
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			});

			$transports = $this->transaction(function($oConn) use ($row) {
				$stmt = $oConn->prepare("SELECT * FROM transports WHERE information_id = ?");
				$stmt->bindValue(1, $row['id']);
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			});

			$data[$index]['places'] = $places;
			$data[$index]['transports'] = $transports;
		}
		return $data;
	}

}

?>