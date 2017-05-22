<?php
error_reporting(E_ALL ^ E_NOTICE); // hide all basic notices from PHP

//If the form is submitted
if(isset($_POST['submitted'])) {

	// require a name from user
	if(trim($_POST['contactName']) === '') {
		$nameError =  'Forgot your name!';
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}

	// need valid email
	if(trim($_POST['email']) === '')  {
		$emailError = 'Forgot to enter in your e-mail address.';
		$hasError = true;
	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
		$emailError = 'You entered an invalid email address.';
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	// we need at least some content
	if(trim($_POST['comments']) === '') {
		$commentError = 'You forgot to enter a message!';
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comments']));
		} else {
			$comments = trim($_POST['comments']);
		}
	}

	// upon no failure errors let's email now!
	if(!isset($hasError)) {

		$emailTo = 'gregclinton1@gmail.com';
		$subject = 'Submitted message from '.$name;
		$sendCopy = trim($_POST['sendCopy']);
		$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
		$headers = 'From: '.$emailTo.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, $subject, $body, $headers);

        // set our boolean completion value to TRUE
		$emailSent = true;
	}
}
?>
<!DOCTYPE html>
 <html lang="en">
  <head>
    <meta charset="utf-8">
    <title>iglaze</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="assets/css/style.min.css" rel="stylesheet">
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">-->
        <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <link rel="stylesheet" href="css/ie.css">
    <![endif]-->
    <script src="assets/js/responsive-nav.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
</head>
  <body>
  <div class="header--container">
    <div class="top--Header">
      <h4>Phone: 01227 722302 </h4>
      <h4>Showroom: 8am - 5pm</h4>
    </div>
      <header>

      <a href="#home" class="logo" data-scroll>iglaze</a>
      <nav class="nav-collapse">
        <ul>
          <li class="menu-item active"><a href="#home" data-scroll>Home</a></li>
          <li class="menu-item"><a href="#about" data-scroll>About</a></li>
          <!-- <li class="menu-item"><a href="#Projects" data-scroll>Projects</a></li> -->
          <!-- <li class="menu-item"><a href="#Order" data-scroll>Order</a></li> -->
          <!-- <li class="menu-item"><a href="#Aluminum" data-scroll>Aluminum</a></li> -->
          <li class="menu-item"><a href="#ContactUs" data-scroll>Contact</a></li>
        </ul>
      </nav>
    </header>
</div>    <!-- header container -->

<!--Home-->

    <section id="home">
      <!-- <img class="retina"src="assets/img/home/home-retina.jpg" alt=""> -->
       <div id="slogan">
          <h1 class="tagline">ALUMINIUM & UPVC</h1>
          <h2 class="tagline2">DESIGN & MANUFACTURE - CONTRACT MANAGEMENT</h2>
       </div>

    </section>

    <!--about-->

        <section id="about">
          <div class="about-text">
            <h3>About <span class="blue">i</span>glaz<span class="blue">e</span></h3>
              <p>iGlaze fabricate a complete range of Smarts Aluminium products including windows, bi-folding doors, sliding doors, residential & commercial doors and curtain walling from our dedicated factory in Kent.</p>
              <p>We offer both supply & delivery for trade clients and design and installation for residential and contractors.</p>
              <p>Our custom quoting & order control software INSTANT Q guides all clients through the process with a high level of detail and efficiency.</p>
              <p>Contact us for a free quotation today. </p>
          </div>
        </section>


    <!--building scroll-->
            <section id="building">
             </section>


    <!-- <section id="Projects">
      <div id="work">
        <h3>Projects</h3>
      </div>
    </section> -->

<!--Order-->

    <!-- <section id="Order">
      <h1>Order</h1>
    </section> -->

<!--Aluminum-->

        <!-- <section id="Aluminum">
      <h1>Aluminum</h1>
    </section> -->


<!--Contacts-->

        <section id="ContactUs">

            <div class="img--right"></div>

      <h1>Contact</h1>


         <!-- @begin contact -->
	<div id="contact">
		<div class="container content">

	        <?php if(isset($emailSent) && $emailSent == true) { ?>
                <p class="info">Your message was sent. <br> We will get back to your soon.</p>
            <?php } else { ?>



				<div id="contact-form">
					<?php if(isset($hasError) || isset($captchaError) ) { ?>
                        <p class="alert">Error submitting the form</p>
                    <?php } ?>

					<form id="contact-us" action="index.php" method="post">
						<div class="formblock">
							<label class="screen-reader-text">Name</label>
							<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="txt requiredField" placeholder="Name:" />
							<?php if($nameError != '') { ?>
								<br /><span class="error"><?php echo $nameError;?></span>
							<?php } ?>
						</div>

						<div class="formblock">
							<label class="screen-reader-text">Email</label>
							<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="txt requiredField email" placeholder="Email:" />
							<?php if($emailError != '') { ?>
								<br /><span class="error"><?php echo $emailError;?></span>
							<?php } ?>
						</div>

						<div class="formblock">
							<label class="screen-reader-text">Message</label>
							 <textarea name="comments" id="commentsText" class="txtarea requiredField" placeholder="Message:"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
							<?php if($commentError != '') { ?>
								<br /><span class="error"><?php echo $commentError;?></span>
							<?php } ?>
						</div>
            <div class="button--containter">
							<button name="submit" type="submit" class="subbutton"><span>Submit<span></button>
							<input type="hidden" name="submitted" id="submitted" value="true" />
            </div>
					</form>
				</div>

			<?php } ?>

    </div>
    </div><!-- End #contact -->
  </section>

  <section class="img--split"></section>

  <section class="Enquiries">
    <div class="img--left"></div>
    <div class="address">
     <h5>Enquiries</h5>
     <p>Wingham Works Unit 1 <br> Goodnestone Road <br> Wingham Kent CT3 1AR</p>
     <p><span>Tel:</span> 01227 722302</p>
     <p><span>Mob:</span> 07983 048078</p>
     <p><span>Email:</span> sales@iglaze.com</p>
    </div>

  </section>

  <footer >
    	&copy; 2017 iGlaze All Rights Reserved
  </footer>

  <!-- <footer class="clearfix">
    	<h6>&copy;2017 iGlaze All rights reserved.</h6>
  </footer> -->

    <script src="assets/js/fastclick.js"></script>
    <script src="assets/js/scroll.js"></script>
    <script src="assets/js/fixed-responsive-nav.js"></script>
    <script src="assets/components/modernizr/modernizr.js"></script>
    <script src="assets/components/jquery/jquery.min.js"></script>
    <script src="assets/js/contacts.js"></script>
    <script src="assets/js/scripts.min.js"></script>
    </script>

    <!-- Google Analytics -->


  </body>
</html>