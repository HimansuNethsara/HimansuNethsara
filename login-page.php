

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Trendy_tech | Login-Page</title>

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/login-style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
	<link rel="icon" href="resources/logo1.png" />
    

</head>

<body>


<div class="container" id="container">

	<!--signup box-->

	<div class="form-container sign-up-container">
		<form action="#">
			<h1>Create Account</h1>

			<div class="login-container">
				<a href="#" class="social"><i class="bi bi-facebook"></i></a>
                <a href="#" class="social"><i class="bi bi-twitter"></i></a>
                <a href="#" class="social"><i class="bi bi-google"></i></a>
				<a href="#" class="social"><i class="bi bi-linkedin"></i></a>
			</div>

			<span>or use your email for registration</span>

			<div class="col-12 d-none" id="msgdiv">
                <div class="alert alert-danger" role="alert" id="msg">

                </div>
            </div>



            <div class="name-inputs">
                <input type="text" placeholder="First Name" id="fname"/>
                <input type="text" placeholder="Last Name" id="lname"/>
            </div>
			<input type="email" placeholder="Email" id="email"/>
			<input type="password" placeholder="Password" id="password"/>
			<input type="password" placeholder="Re-enter Password" id="repassword"/>
            <div class="name-inputs">
                <input type="text" placeholder="Mobile" id="mobile" />
                <select id="gender">
                    <option value="0">Select Your Gender</option>
					<?php
                        require "connection.php";

                        $rs = Database::search("SELECT * FROM `gender`");
                        $n = $rs->num_rows;

                        for ($x = 0; $x < $n; $x++) {
                            $d = $rs->fetch_assoc();

                    ?>

                        <option value="<?php echo $d["id"]; ?>"><?php echo $d["gender_name"]; ?></option>

                    <?php

                        }

                    ?>                    
                </select>
            </div>
			<button style="margin-top: 10px;" onclick="signUp();">Sign Up</button>
		</form>
	</div>

	<!--signup box-->

	<!--signin box-->

	<div class="form-container sign-in-container">
		<form action="#">
			<h1>Sign in</h1>

			<?php
                $email = "";
                $password = "";

                if (isset($_COOKIE["email"])) {
                	$email = $_COOKIE["email"];
                }

                if (isset($_COOKIE["password"])) {
                    $password = $_COOKIE["password"];
                }
            ?>

			<div class="login-container">
				<a href="#" class="social"><i class="bi bi-facebook"></i></a>
                <a href="#" class="social"><i class="bi bi-twitter"></i></a>
                <a href="#" class="social"><i class="bi bi-google"></i></a>
				<a href="#" class="social"><i class="bi bi-linkedin"></i></a>
			</div>
			<span>or use your account</span>
			<input type="email" placeholder="Email" id="email2" value="<?php echo $email; ?>"/>
			<input type="password" placeholder="Password" id="password2" value="<?php echo $password; ?>"/>

			<div class="show-password-container">
				<input class="form-check-input" style="transform: scale(0.6);" type="checkbox" id="show-password-checkbox" onclick="showPassword_check();" />
				<label for="show-password-checkbox" style="margin-top: 8px; font-size: 10px">Show Password</label>
        	</div>
			
			<div class="checkbox-forgot-container">
				<div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="rememberme" style="margin-top: -4px; transform: scale(0.6);">
                    <label class="form-check-label" style="margin-right: 88px; " for="rememberme">
                        Remember Me
                    </label>
					<a href="#" class="link-success" onclick="forgotPassword();"> Forgotten Password?</a>
                </div>
                
            </div>

			<button onclick="signIn();">Sign In</button>
		</form>
	</div>

	<!--signin box-->

	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="transparent" id="signIn" onclick="showSignInPanel()">Sign In</button>
				<br/>
				<h5 style="font-family: StoryElement;">" Your Future. Our Passion. "</h5>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
				<p>Enter your personal details and start journey with us</p>
				<button class="transparent" id="signUp" onclick="showSignUpPanel()">Sign Up</button>
				<br/>
				<h5 style="font-family: StoryElement;">" Your Future. Our Passion. "</h5>
			</div>
		</div>
	</div>
</div>

<!-- modal -->
<div class="modal" tabindex="-1" id="forgotPasswordModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Forgot Password?</h5>
                <button type="button" class="btn-close  " data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">

                    <div class="col-6">
                        <label class="form-label">New Password</label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" id="np" />
                        </div>
                    </div>

                    <div class="col-6">
                        <label class="form-label">Retype New Password</label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" id="rnp" />
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Verifiction Code</label>
                        <input type="text" class="form-control" id="vc" style="color: #3EB489;" />
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="resetPassword();">Reset Password</button>
            </div>
        </div>
    </div>
</div>
<!-- modal -->


<script src="js/bootstrap.bundle.js"></script>
<script src="js/script.js"></script>
<script src="js/bootstrap.js"></script>

</body>

</html>