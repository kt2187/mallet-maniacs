<?php
  // Message Vars
  $msg = '';
  $msgClass = '';

  // Check For Submit
  if(filter_has_var(INPUT_POST, 'submit')){
    // Get Form Data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Check Required Fields
    if(!empty($email) && !empty($name) && !empty($message)){
      // Passed
      // Check Email
      if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
        // Failed
        $msg = 'Please use a valid email';
        $msgClass = 'alert-danger';
      } else {
        // Passed
        $toEmail = 'kt@katiebarriere.com';
        $subject = 'Contact Request From '.$name;
        $body = '<h2>Contact Request</h2>
          <h4>Name</h4><p>'.$name.'</p>
          <h4>Email</h4><p>'.$email.'</p>
          <h4>Message</h4><p>'.$message.'</p>
        ';

        // Email Headers
        $headers = "MIME-Version: 1.0" ."\r\n";
        $headers .="Content-Type:text/html;charset=UTF-8" . "\r\n";

        // Additional Headers
        $headers .= "From: " .$name. "<".$email.">". "\r\n";

        if(mail($toEmail, $subject, $body, $headers)){
          // Email Sent
          $msg = 'Your email has been sent';
          $msgClass = 'alert-success';
        } else {
          // Failed
          $msg = 'Your email was not sent';
          $msgClass = 'alert-danger';
        }
      }
    } else {
      // Failed
      $msg = 'Please fill in all fields';
      $msgClass = 'alert-danger';
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.13.0/css/all.css"
      integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V"
      crossorigin="anonymous"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/style.min.css" />
    <title>Katie Barriere</title>
  </head>
  <body data-theme="dark">
    <div class="menu-wrap">
        <input type="checkbox" class="toggler" />
        <div class="hamburger"><div></div></div>
        <div class="menu">
          <div>
            <div>
              <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="projects.html">Projects</a></li>
                <li><a href="github.html">GitHub</a></li>
                <li><a href="tweets.html">Tweets</a></li>
                <li><a href="http://www.askmeaboutmycats.com/index.php">Contact</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    <!-----------------------------CONTACT---------------------------------->
    <section class="container">
        <h3 class="dark-color large contact-main-title">
          Get<span> in Touch</span>
        </h3>
      </div>
      <div class="social contact-icons p-2">
        <a
          href="https://www.github.com/kt2187"
          target="_blank"
          rel="noopener noreferrer"
        >
          <i class="fab fa-github fa-2x"></i>
        </a>
        <a
          href="https://www.twitter.com/katiebarriere"
          target="_blank"
          rel="noopener noreferrer"
        >
          <i class="fab fa-twitter fa-2x"></i>
        </a>
        <a
          href="https://www.facebook.com/katiebarriere"
          target="_blank"
          rel="noopener noreferrer"
        >
          <i class="fab fa-facebook fa-2x"></i>
        </a>
        <a
          href="https://www.linkedin.com/in/katiebarriere"
          target="_blank"
          rel="noopener noreferrer"
        >
          <i class="fab fa-linkedin fa-2x"></i>
        </a>
      </div>
      <?php if($msg != ''): ?>
        <div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
      <?php endif; ?>
      <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
        <input type="text" name="name" class="form-control" value="<?php echo isset($_POST['name']) ? $name : ''; ?>" placeholder="Your name" id="name">
    </div>
        <div class="form-group">
            <input type="text" name="email" placeholder="Email address" id="email" class="form-control" value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
            </div>
        </div>
        <div class="form-group">
            <textarea placeholder="Message" name="message" rows="4" id="message" class="form-control"><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
      </div>
    </section>
    <footer>
      Copyright <span>&copy;</span> 2020. Website and projects designed and
      developed by <span>Katie</span> Barriere
    </footer>
  </body>
</html>
