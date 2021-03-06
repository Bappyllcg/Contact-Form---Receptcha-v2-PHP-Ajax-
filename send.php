<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        # FIX: Replace this email with recipient email
        $mail_to = "bappy.llcg@gmail.com";
        
        # Sender Data
        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $phone = trim($_POST["phone"]);
        $format = trim($_POST["format"]);
        $message = trim($_POST["message"]);

        
        if ( empty($name) OR empty($email) OR empty($phone) OR empty($format) OR empty($message)) {
            # Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Please complete the form and try again.";
            exit;
        }

        // getting the captcha
    $captcha = '';
    if (isset($_POST['g-recaptcha-response']))
        $captcha = $_POST['g-recaptcha-response'];
    //echo 'captcha: '.$captcha;

    if (!$captcha)
        echo 'The captcha has not been checked.';
        // handling the captcha and checking if it's ok
        $secret = '6LeaO3MaAAAAAMBsfPA_1pP9VmogOnwlQdadl0Ip';
        $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);

        if ($response['success'] != false) {
            // send the actual mail
           // @mail($email_to, $subject, $finalMsg);

            // the echo goes back to the ajax, so the user can know if everything is ok
            //echo 'ok';
        }
        
        # Mail Content
        $content = "Name: $name\n";
        $content .= "Email: $email\n";
        $content .= "Phone: $phone\n";
        $content .= "Format: $format\n";
        $content .= "Message: $message\n";

        # email headers.
        $headers = "From: $name &lt;$email&gt;";

        # Send the email.
        $success = mail($mail_to,'New Message From: '.$name.' ', $content);
        if ($success && $response['success']) {
            # Set a 200 (okay) response code.
            http_response_code(200);
            echo "Thank You! Your message has been sent.";
        } else {
            # Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Something went wrong, we couldn't send your message.";
        }

        } else {
            # Not a POST request, set a 403 (forbidden) response code.
            http_response_code(403);
            echo "There was a problem with your submission, please try again.";
        }
?>
