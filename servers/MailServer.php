<?php

require_once __DIR__.'/General.php';
require_once __DIR__.'/MailSend.php';

require_once __DIR__.'/../traits/ProcessPetition.php';

class MailServer {

	use ProcessPetition;

	private $mailbox = '{'.General::HOST.':'.General::PORT_TO_READ.'/imap/ssl/novalidate-cert}INBOX';

	public function runServer()
	{
		while (true) {
			$conn = imap_open($this->mailbox, General::USERNAME, General::PASSWORD);
			$msg_cnt = imap_num_msg($conn);
			for($i = $msg_cnt; $i >= 1; $i--) {
				$header = imap_headerinfo($conn, $i);
				$subject = trim($header->subject);

				if ($subject == 'CONSULTA_DATA') {
					$mail_message = trim(imap_fetchbody($conn,$i, 2));
					imap_delete($conn, $i);
					$oResponse = $this->process($subject);

					//------------------------------------------------------
					$oMailSend = new MailSend;
					$oMailSend->send('testups18@gmail.com', 'Alguien', 'ENVIA_RESPONSE', $oResponse);
					//------------------------------------------------------
				}

				break;
			}

		}
	}

}

?>