<?php

require_once('config.php');
require_once('classes/MessageStatus.php');
require_once('classes/DataService.php');
require_once('classes/Apns.php');


echo "<br/>Started processing message queue";

//get the certificates
$certificates = DataService::singleton()->getCertificates();


foreach ($certificates as $certificate) {

    //get N new messages from queue. We can get more messages on the next schedule
    echo "<br/>Getting messages for: [{$certificate->CertificateName}]";
    //var_dump($certificate);
    $messagesArray = DataService::singleton()->getMessages($certificate->CertificateId, MessageStatus::UNPROCESSED, 1000);

    //if no messages for app continue with next
    if (count($messagesArray) == 0) {
        continue;
    }

    //connect to apple push notification server with the app credentials
    $certificatePath = $certificateFolder . '/' . $certificate->KeyCertFile;
    echo $certificatePath;
    
    $server = DataService::singleton()->getCertificateServer($certificate->CertificateId, 1);
    //var_dump($server);
    $apns = new apns($server->ServerUrl, $certificatePath, $certificate->Passphrase);

    //send each message
    foreach ($messagesArray as $message) {

        //send payload to device
        $apns->sendMessage($message->DeviceToken, $message->Message, $message->Badge, $message->Sound);

        //mark as sent
        DataService::singleton()->setMessageStatus($message->MessageId, 2);
    }

    //execute the APNS desctructor so the connection is closed.
    unset($apns);
}
echo "<br/>Completed processing messages queue";