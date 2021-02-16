<?php session_start();
    if (isset($_POST['submit'])) {
        if (isset($_SESSION['mail_counter'])) {
            if ($_SESSION['mail_counter'] <= 5) {
                $regex = "/[<>{}]+/i";
                $name = preg_replace($regex, "#", $_POST['name']);
                $from = $_POST['email'];
                $msg = preg_replace($regex, "#", $_POST['message']);
                
                #sendmail
                $to = 'tibordraganmusic@gmail.com';
                $subject = "Weblap kontakt:" .$name;

                $message = "<h3>Új üzenet a weblapról</h3>";
                $message .= "<h5>Feladó: $name</h5>";
                $message .= '<h5>Email: '.$from.'</h5>';
                $message .= "<h5><b>Üzenet:</b><br>" . $msg . "</h5>";
                $message = str_replace('\n', "\n", $message);
                $message = str_replace('\r', "\r", $message);
                //$message = str_replace('\n.', "\n..", $message);

                $headers = "From: " . $name . " <". $from .">\r\n";
                $headers .= "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type: text/html;charset=UTF-8" . "\r\n";
                $mail = mail($to, $subject, $message, $headers);
                $_SESSION['mail_counter'] += 1;
                $_SESSION['mail_success'] = true;
            } else {
                $_SESSION['mail_success'] = false;
            }
        } else {
            $_SESSION['mail_counter'] = 0;
        }
    }
    // if (isset($mail)) {
    //     echo $mail ? "<h1>Email Sent Successfully!</h1>" : "<h1>Email sending failed.</h1>";
    // }
    header('Location: ./index.html');
    exit;
