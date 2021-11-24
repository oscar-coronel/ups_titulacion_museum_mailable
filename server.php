<?php

require_once __DIR__.'/servers/MailServer.php';

$oMailServer = new MailServer;

$oMailServer->runServer();

?>