<?php
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = strip_tags(trim($_POST["namesurname"]));
		$name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $cellphone = trim($_POST["cell"]);
        $website = trim($_POST["website"]);
        if ( empty($name) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo "Oops! There was a problem with your submission. Please complete the form and try again.";/*--------- Contact submission erroe Message ---------------*/
            exit;
        }
        $recipient = "michel@statelygroup.co"; /*----- Add your email address here------*/
        $subject = "Your Subject $name";/*------ Add your email subject here------*/
        $email_content = "Name: $name\n\n";
        $email_content .= "\nEmail: $email\n\n";
        $email_content .= "\nCellphone Number:\n$cell\n";
        $email_content .= "\nWebsite:\n$website\n";
        $email_headers = "From: $name <$email>";
        if (mail($recipient, $subject, $email_content, $email_headers)) {

            http_response_code(200);
            echo "Thank You! Your message has been sent."; /*---------  Success Message ---------------*/
        } else {

            http_response_code(500);
            echo "Oops! Something went wrong and we couldn't send your message."; /*--------- Contact Error Message ---------------*/
        }
    } else {
        http_response_code(403);
        echo "There was a problem with your submission, please try again."; /*--------- Contact submission erroe Message ---------------*/
    }
?>
