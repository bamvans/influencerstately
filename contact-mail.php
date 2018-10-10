<?php
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = strip_tags(trim($_POST["namesurname"]));
		$name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $message = trim($_POST["description"]);
        $youtubelink = trim($_POST["youtube"]);
        $instagramlink = trim($_POST["instagram"]);
        if ( empty($name)  OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo "Oops! There was a problem with your submission. Please complete the form and try again.";/*--------- Contact submission erroe Message ---------------*/
            exit;
        }
        $recipient = "nunez.s@statelygroup.co"; /*----- Add your email address here------*/
        $subject = "Your Subject $name";/*------ Add your email subject here------*/
        $email_content = "Name: $name";
        $email_content .= "email: $email\n\n";
        $email_content .= "youtube: $youtubelink\n\n";
        $email_content .= "instagram: $instagramlink\n\n";
        $email_content .= "description:\n$message\n";
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
