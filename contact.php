


<?php
if (isset($_POST['submit'])) {
$to = "kishorexcent@gmail.com";
$subject = wordwrap($_POST['subject']);
$body = $_POST['body'];

// $from = $_POST['email'];
$header = "From: " .$_POST['email'];

$mail_success = mail($to, $subject, $body, $header);

if ($mail_success) {
    echo "Email sent successfully!";
} else {
    echo "Failed to send email.". error_get_last();
}

    
}


// $name = $_POST["name"];
// $email = $_POST["email"];
// $subject = $_POST["subject"];
// $message = $_POST["body"];

// require "vendor/autoload.php";

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;

// $mail = new PHPMailer(true);

// // $mail->SMTPDebug = SMTP::DEBUG_SERVER;

// $mail->isSMTP();
// $mail->SMTPAuth = true;

// $mail->Host = "smtp.example.com";
// $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
// $mail->Port = 587;

// $mail->Username = "you@example.com";
// $mail->Password = "password";

// $mail->setFrom($email, $name);
// $mail->addAddress("kishorexcent@gmail.com", "kishore");

// $mail->Subject = $subject;
// $mail->Body = $message;

// $mail->send();
?>

<!DOCTYPE html>
<html lang="en">

 <?php  include "includes/header.inc.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/nav.inc.php"; ?>
    
 <body>
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
                        
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your Email">
                        </div>

                         <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter your subject">
                        </div>
                        
                         <div class="form-group">
                           <textarea class = "form-control" name="body" id="body" cols="30" rows="10"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.inc.php";?>
</body>
</html>
