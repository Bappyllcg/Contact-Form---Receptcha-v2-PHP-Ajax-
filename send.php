<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        # FIX: Replace this email with recipient email
        $mail_to = "gabyjoemedia@gmail.com";
        
        # Sender Data
        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $phone = trim($_POST["phone"]);
        $cetagory = trim($_POST["cetagory"]);
        if(empty($cetagory)){
            $cetagory = ' ';
        }
        $message = trim($_POST["message"]);
        if(empty($message)){
            $message = ' ';
        }
		
        if (empty($name) OR empty($email) OR empty($phone)) {
            # Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Please complete the form and try again.";
            exit;
        }

        // getting the captcha
		$captcha = '';
        if (isset($_POST['g-recaptcha-response'])){
            $captcha = $_POST['g-recaptcha-response'];
        }

        if (!$captcha){
            # Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo 'Please check captcha.';
            exit;
        }
        
        // handling the captcha and checking if it's ok
        $secret = '6LcCUggjAAAAAEJZdKzXcQRv96TuOaQJuJf-FJ5D_';
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
		$content .= "Category: $cetagory\n";
		$content .= "Message: $message\n";

		# email headers.
		$headers = "From: $first_name &lt;$email&gt;";

		# Send the email.
		$success = mail($mail_to,'New Message From: '.$name.'-'.$promotion, $content);
		if ($success) {
			# Set a 200 (okay) response code.
			http_response_code(200);
			echo "Thank You! Your message has been sent.";
			exit;
		} else {
			# Set a 500 (internal server error) response code.
			http_response_code(500);
			echo "Oops! Something went wrong, we couldn't send your message.";
			exit;
		}

	} else {
		# Not a POST request, set a 403 (forbidden) response code.
		http_response_code(403);
		echo "There was a problem with your submission, please try again.";
	}
?>
