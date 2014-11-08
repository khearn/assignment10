<?php
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
//
// This function mails the text passed in to the people specified 
// it requires the person sending it to and a message 
// CONSTRAINTS:
//      $to must not be empty
//      $to must be an email format
//      $cc must be an email format if its not empty
//      $bcc must be an email format if its not empty
//      $from must not be empty
//      $subject must not be empty
//      $message must not be empty
//      $message must have a minium number of characters
//      $message must be a minuim lenght (just count the characters and spaces
//      
//      $from should be cleand of invalid html before being sent here but needs 
//            to allow < and >
//      $message should be cleand of invalid html before being sent here as you 
//            may want to allow html characters
//
// function returns a boolean value
function sendMail($data){ 
    $MIN_MESSAGE_LENGTH=40;
    
    $blnMail=false;
   
    $start = htmlentities($_POST["txtStartTime"],ENT_QUOTES,"UTF-8");
    $subject = htmlentities($_POST["txtSubject"],ENT_QUOTES,"UTF-8");
    $number = htmlentities($_POST["txtNumber"],ENT_QUOTES,"UTF-8");
    $building = htmlentities($_POST["lstBuildings"],ENT_QUOTES,"UTF-8");
    $professor = htmlentities($_POST["txtProfessor"],ENT_QUOTES,"UTF-8");
    $type = htmlentities($_POST["lstType"],ENT_QUOTES,"UTF-8");
     
    if(empty($data)) return false;
    if (strlen($data)<$MIN_MESSAGE_LENGTH) return false;
    
    /* message */
    $messageTop  = '<html><head><title>' . $subject . '</title></head><body>';
    $mailMessage = $messageTop . $message;

    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";

    $headers .= "From: " . $from . "\r\n";

    if ($cc!="") $headers .= "CC: " . $cc . "\r\n";
    if ($bcc!="") $headers .= "Bcc: " . $bcc . "\r\n";

    /* this line actually sends the email */
    $blnMail=mail($to, $subject, $mailMessage, $headers);
    
    return $blnMail;
}
?>