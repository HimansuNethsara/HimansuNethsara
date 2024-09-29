<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Trendy_tech | Login-Page</title>

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/login-style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
	<link rel="icon" type="image/png" href="images/logo.png">
    <style>
        .additional-content {
            float: right; /* Align content to the right side */
            width: 50%; /* Adjust the width as needed */
            padding: 20px; /* Add padding to the content */
            background-color: #3EB489; /* Add a background color */
            height: 650px;
        }
    </style>
</head>

<body>


<div class="container" id="container">
    <!-- Signin box -->
    <div class="form-container admin-sign-in-container">
        <form action="#">
            <h1>Admins Login</h1>
            <div class="col-12 d-none" id="msgdiv2">
                <div class="alert alert-danger" role="alert" id="msg2">
                </div>
            </div>
            <input type="email" placeholder="Email" id="admin_email" placeholder required/><br/>
            <button onclick="adminVerification();">Send Verification Code</button><br/>
            <button style="background-color: red; border: 2px solid red;" onmouseover="this.style.backgroundColor='#cc0000'; this.style.borderColor='#cc0000';" onmouseout="this.style.backgroundColor='red'; this.style.borderColor='red';" onclick="window.location='index.php';">Back to Homepage</button>
        </form>
    </div>
    <!-- Right side content -->
    <div class="additional-content">
        <div class="text-white px-3 py-4 p-md-5 mx-md-4">
            <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                 Welcome Back, Admin! <br />
                <span class="h1 fw-bold" style="color: hsl(218, 66%, 72%)">Manage Your Shop's Inventory</span> with Ease
            </h1>
            <p class="small mb-0">Sign in to your admin account to access powerful tools for managing your shop's inventory of mobile phones, laptops, and other electronic devices. 
                At Trendy_tech, we provide you with the tools you need to streamline your operations and stay ahead in the fast-paced world of technology retail.</p>

        </div>
    </div>
</div>
<!-- modal -->
<div class="modal" tabindex="-1" id="verificationModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Admin Verification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label class="form-label">Enter Your Verification Code</label>
                <input type="text" class="form-control" id="vcode">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" onclick="verify();">Verify</button>
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