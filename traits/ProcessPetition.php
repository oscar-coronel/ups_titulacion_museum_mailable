<?php

require_once __DIR__.'/../models/Information.php';

trait ProcessPetition {


	public function process($petition){

		$oInformation = new Information;

		switch ($petition) {
			case 'CONSULTA_DATA':
				$data = $oInformation->getAllInfo();
				return $this->toJson( $data );
				break;

			default:
				$message = "Petición no soportada.";
				echo $message."\n";
				return $message;
				break;
		}

	}

	private function toJson($oData)
	{
		return json_encode( [ 'data' => $oData ] );
	}

}

?>