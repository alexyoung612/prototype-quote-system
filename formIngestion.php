<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

//Load Composer's autoloader
require 'vendor/autoload.php';


if((!empty($_POST['superSecretPass']) && $_POST['superSecretPass'] === '[code]') || (!empty($_SESSION['superSecretPass']) && $_SESSION['superSecretPass'] === '[code]')){
    // success code goes here later
} else {
    die('incorrect password');
}

//check if this is first submit. if yes, generate new random ID.
if(isset($_POST['newForm'])){
    $_SESSION['quoteID'] = generateRandomID();
}

// convert all POST values to SESSION. allows data persistence across multiple pages.
foreach ( $_POST as $key=>$value ) {
    $_SESSION[$key] = $value;
}

// unset new form so no new quote ID is generated.
unset($_POST['newForm']);

$_SESSION['numberOfScreens'] = isset($_SESSION['boxFace']) ? count($_SESSION['boxFace']) : 0; // number of screens
$_SESSION['numberOfAwnings'] = isset($_SESSION['awningStyle']) ? count($_SESSION['awningStyle']) : 0; // number of awnings
$validCustomerEmail = !empty($_SESSION['customerEmail'][0]); //boolean for valid customer email

// create backend email and store to variable
ob_start();
include 'emailTemplates/backendEmail.php';
$backendEmailContents = ob_get_contents();
ob_end_clean();

// create customer email and store to variable
ob_start();
include 'emailTemplates/customerEmail.php';
$customerEmailContents = ob_get_contents();
ob_end_clean();

if(isset($_POST['sendEmail'])){

    $sendingEmailAddress; // the email address to send to

    if($_POST['sendEmail'] == 'customer'){
        $sendingEmailAddress = filter_var($_SESSION['customerEmail'][0], FILTER_SANITIZE_EMAIL);
    }
    if($_POST['sendEmail'] == 'backend'){
        $sendingEmailAddress = '[live email]'; // LIVE
        // $sendingEmailAddress = '[test email]'; // DEBUG
    }


    if (!filter_var($sendingEmailAddress, FILTER_VALIDATE_EMAIL)) {
        die($sendingEmailAddress . ' is not a valid email address');
    }


    $mail = new PHPMailer(true); // Passing `true` enables exceptions
    try {



        //Server settings for debug
        // $mail->SMTPDebug = 0; // Enable verbose debug output
        // $mail->isSMTP(); // Set mailer to use SMTP
        // $mail->Host = 'smtp.gmail.com;smtp2.example.com'; // Specify main and backup SMTP servers
        // $mail->SMTPAuth = true; // Enable SMTP authentication
        // $mail->Username = ''; // SMTP username
        // $mail->Password = ''; // SMTP password
        // $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
        // $mail->Port = 587; // TCP port to connect to
        // $mail->setFrom('', 'Test Quote Server');

        //Live server settings
        $mail->SMTPDebug = 0; // Enable verbose debug output
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = ''; // Specify main and backup SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = ''; // SMTP username
        $mail->Password = ''; // SMTP password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587; // TCP port to connect to
        $mail->setFrom('', '[AA]');

        //Recipients
        $mail->addAddress($sendingEmailAddress, $_SESSION['customerName'][0]); // Add a recipient
        $mail->addReplyTo('', 'Sales');
        //$mail->addCC('cc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        //Content
        $mail->isHTML(true); // Set email format to HTML

        switch($_POST['sendEmail']){
            case 'customer':
                $mail->Subject = '[AA]';
                break;
            case 'backend':
                $mail->Subject = 'Backend Mail Quote ' . $date->format('Y-m-d H:i');
                break;
            default:
                $mail->Subject = 'Default Mail Quote ' . $date->format('Y-m-d H:i');
                break;
        }

        if($_POST['sendEmail'] == 'customer'){
            $mail->Body = $customerEmailContents;
        }
        if($_POST['sendEmail'] == 'backend'){
            $mail->Body = $backendEmailContents;
        }
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
        $sentEmail = TRUE; // whether or not the email was sent
    } catch (Exception $e) {
        $emailErrorMessage = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
        echo $emailErrorMessage;
        $sentEmail = FALSE; // whether or not the email was sent
    }

    //unset post so email doesn't get resent on page change.
    unset($_POST['sendEmail']);
}

/** generate a string to keep track
 ** @param {int} length of the string to return, default 6 characters
 ** @return {string} a random alphanumeric string
 **/
function generateRandomID($length = 6){
    $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ1234567890';
    $charactersLength = strlen($characters);
    $randomIDString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomIDString .= $characters[rand(0, $charactersLength - 1)];
    }
    $randomIDString .= '-' . date('y');
    return $randomIDString;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>[AA] Mail Quote Submit</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/theme.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</head>
<div class="jumbotron text-center">
    <h1>[AA] Automated Quote System</h1>
</div>
<?php
    //all alerts are posted here

    //sent email
    if(isset($sentEmail) && $sentEmail == TRUE){
        echo '<div class="alert alert-success" role="alert">
        Email sent successfully to ' . $sendingEmailAddress .
        '</div>';
    }
    //email failed
    if(isset($sentEmail) && $sentEmail == FALSE){
        echo '<div class="alert alert-danger" role="alert">
        Email unsuccessful. ' . $emailErrorMessage .
        '</div>';
    }
    // no customer email input
    if(!$validCustomerEmail){
        echo '<div class="alert alert-warning" role="alert">
        Invalid customer email input.' .
        '</div>';
    }
    // no awnings or screens input
    if($_SESSION['numberOfAwnings'] === 0 && $_SESSION['numberOfScreens'] === 0){
        echo '<div class="alert alert-danger" role="alert">
        No awnings or screens input.' .
        '</div>';
    }

?>
<hr>
<div class="d-flex justify-content-center">
    <form id="commandForm" method="post" action="" class="align-center">
        <button type="button" id="viewCustomerEmailButton" class="btn btn-info">View Customer Email</button>
        <button type="button" id="viewBackendEmailButton" class="btn btn-info">View Backend Email</button>
        <button type="submit" name="sendEmail" value="customer" id="sendCustomerEmailButton" class="btn btn-primary">Send Customer Email</button>
        <button type="submit" name="sendEmail" value="backend" id="sendCustomerEmailButton" class="btn btn-primary">Send Backend Email</button>
        <a href="./index.php" class="btn btn-success" role="button">Return to Main Page</a>
    </form>
</div>
<hr>
<div id="customerEmail" class="displaySection">
    <?= $customerEmailContents; ?>
</div>
<div id="backendEmail" class="displaySection">
    <?= $backendEmailContents; ?>
</div>

<script>
    var viewCustomerEmailButton = $('#viewCustomerEmailButton');
    var viewBackendEmailButton = $('#viewBackendEmailButton');
    var customerEmailDisplay = $('#customerEmail');
    var backendEmailDisplay = $('#backendEmail');

    backendEmailDisplay.hide();
    customerEmailDisplay.hide();

    viewCustomerEmailButton.click(function(){
        backendEmailDisplay.hide();
        customerEmailDisplay.show();
    });

    viewBackendEmailButton.click(function(){
        customerEmailDisplay.hide();
        backendEmailDisplay.show();
    });
</script>