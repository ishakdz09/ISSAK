<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    exit('Something Went Wrong!');
}
require_once('../db/database.php');
$conn = Database::getInstance($_SERVER['HTTP_X_API_KEY']);

$Mail = $_GET['mail'];

$config = getConfig($conn);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../admin/public/PHPMailer/src/Exception.php';
require '../admin/public/PHPMailer/src/PHPMailer.php';
require '../admin/public/PHPMailer/src/SMTP.php';




$d=strtotime("now");
$Current_DT =  date("Y-m-d h:i:s", $d);
$Current_DT_encoded = base64_encode($Current_DT);


$stmt = $conn->prepare("SELECT * FROM user_db WHERE email=?");
$stmt->execute([$Mail]); 
if($stmt->fetchColumn() == "") {
    echo "Email Not Registered";
} else {
    $sql = "INSERT INTO mail_token_details (token, mail, type)
    VALUES ('$Current_DT_encoded', '$Mail', 'Password Reset')";
    $conn->exec($sql);
    if($conn->lastInsertId() == "") {
        echo "Something Went Wrong!";
    } else {
        //header("Location: reset_password_mail.php?token=$Current_DT_encoded&mail=$Mail&appurl=$appurl");
        sendMail($Current_DT_encoded, $Mail, $config);
    }
}

function getConfig($conn) {
    $resultat = $conn->query("SELECT * FROM config WHERE id = 1");
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $json =array();
    while( $Data = $resultat->fetch() ) 
    {
        return $Data;
    }
}

function sendMail($Token, $Mail, $Config) {

    $name = $Config->name;
    $Contact_Email = $Config->Contact_Email;
    $Host = $Config->SMTP_Host;
    $Username = $Config->SMTP_Username;
    $Password = $Config->SMTP_Password;
    $Port = $Config->SMTP_Port;

    $mail = new PHPMailer(true);

    try {

        //Server settings
    
        $mail->SMTPDebug = SMTP::DEBUG_OFF ;                      //Enable verbose debug output //DEBUG_SERVER
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = $Host;                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $Username;                     //SMTP username
        $mail->Password   = $Password;                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = $Port;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ));

        $mail->setFrom($Username, $name);
        $mail->addAddress($Mail);
        $mail->addReplyTo($Contact_Email, $name);
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'PASSWORD RESET';

        $mail->Body    = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

    <html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

    

    <head>

        <meta charset="UTF-8">

        <meta content="width=device-width, initial-scale=1" name="viewport">

        <meta name="x-apple-disable-message-reformatting">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta content="telephone=no" name="format-detection">

        <title></title>

        <!--[if (mso 16)]>

        <style type="text/css">

        a {text-decoration: none;}

        </style>

        <![endif]-->

        <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->

        <!--[if gte mso 9]>

    <xml>

        <o:OfficeDocumentSettings>

        <o:AllowPNG></o:AllowPNG>

        <o:PixelsPerInch>96</o:PixelsPerInch>

        </o:OfficeDocumentSettings>

    </xml>

    <![endif]-->

    </head>

    

    <body>

        <div class="es-wrapper-color">

            <!--[if gte mso 9]>

                <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">

                    <v:fill type="tile" color="#fafafa"></v:fill>

                </v:background>

            <![endif]-->

            <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">

                <tbody>

                    <tr>

                        <td class="esd-email-paddings" valign="top">

                            <table class="es-content esd-footer-popover" cellspacing="0" cellpadding="0" align="center">

                                <tbody>

                                    <tr>

                                        <td class="esd-stripe" style="background-color: #fafafa;" bgcolor="#fafafa" align="center">

                                            <table class="es-content-body" style="background-color: #ffffff;" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">

                                                <tbody>

                                                    <tr>

                                                        <td class="esd-structure es-p40t es-p20r es-p20l" style="background-color: transparent; background-position: left top;" bgcolor="transparent" align="left">

                                                            <table width="100%" cellspacing="0" cellpadding="0">

                                                                <tbody>

                                                                    <tr>

                                                                        <td class="esd-container-frame" width="560" valign="top" align="center">

                                                                            <table style="background-position: left top;" width="100%" cellspacing="0" cellpadding="0">

                                                                                <tbody>

                                                                                    <tr>

                                                                                        <td class="esd-block-image es-p5t es-p5b" align="center" style="font-size:0"><a target="_blank"><img src="https://tlr.stripocdn.email/content/guids/CABINET_dd354a98a803b60e2f0411e893c82f56/images/23891556799905703.png" alt style="display: block;" width="175"></a></td>

                                                                                    </tr>

                                                                                    <tr>

                                                                                        <td class="esd-block-text es-p15t es-p15b" align="center">

                                                                                            <h1 style="color: #333333; font-size: 20px;"><strong>FORGOT YOUR </strong></h1>

                                                                                            <h1 style="color: #333333; font-size: 20px;"><strong>&nbsp;PASSWORD?</strong></h1>

                                                                                        </td>

                                                                                    </tr>

                                                                                    <tr>

                                                                                        <td class="esd-block-text es-p40r es-p40l" align="center">

                                                                                            <p>HELLO</p>

                                                                                        </td>

                                                                                    </tr>

                                                                                    <tr>

                                                                                        <td class="esd-block-text es-p35r es-p40l" align="left">

                                                                                            <p style="text-align: center;">There was a request to change your password!</p>

                                                                                        </td>

                                                                                    </tr>

                                                                                    <tr>

                                                                                        <td class="esd-block-text es-p25t es-p40r es-p40l" align="center">

                                                                                            <p>If did not make this request, just ignore this email. Otherwise, please use This Code below to change your password:</p>

                                                                                        </td>

                                                                                    </tr>

                                                                                    <tr>

                                                                                        <td class="esd-block-button es-p40t es-p40b es-p10r es-p10l" align="center"><span class="es-button-border"><h1>'.$Token.'</h1>RESET PASSWORD</a></span></td>

                                                                                    </tr>

                                                                                </tbody>

                                                                            </table>

                                                                        </td>

                                                                    </tr>

                                                                </tbody>

                                                            </table>

                                                        </td>

                                                    </tr>

                                                </tbody>

                                            </table>

                                        </td>

                                    </tr>

                                </tbody>

                            </table>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </body>

    

    </html>';

        $mail->send();
        echo 'Message has been sent';

    } catch (Exception $e) {

        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    
    }
}