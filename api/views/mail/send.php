<?php

    include('class.simple_mail.php');

    if(isset($_REQUEST['email_to']) && 
            isset($_REQUEST['email_from']) && 
            isset($_REQUEST['name_to']) && 
            isset($_REQUEST['name_from']) && 
            isset($_REQUEST['email_subject']) && 
            isset($_REQUEST['email_message'])) {
     
        // EDIT THE 2 LINES BELOW AS REQUIRED
        $email_to = $_REQUEST['email_to']; //"info@hamgt.com";
        $email_from = $_REQUEST['email_from']; //"info@hamgt.com";
        $name_to = $_REQUEST['name_to']; //'Harvest Asset Management';
        $name_from = $_REQUEST['name_from']; //'Harvest Asset Management';
        $email_subject = $_REQUEST['email_subject']; //"Message from HAMGT.COM";
        $email_message = $_REQUEST['email_message'];
     
         // Just to be sure that send the mail
        $send = SimpleMail::make()
            ->setTo($email_to, $name_to)
            ->setFrom($email_from, $name_from)
            ->setSubject($email_subject)
            ->setMessage($email_message)
            ->setHtml()
            ->send();
    }
?>