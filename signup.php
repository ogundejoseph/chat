<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){ //if user is logged in
        header("location: users.php");
    }
?>
<?php include_once "header.php"; ?>
<body>
    <div class="wrapper">
        <section class="form signup">
            <header>Realtime chat App</header>
            <form action="#" enctype="multipart/form-data" autocomplete="off">
                <div class="error-text"></div>
                <div class="name-details">
                    <div class="field input">
                        <label>First Name</label>
                        <input type="text" name="fname" placeholder="Enter first name" required>
                    </div>
                    <div class="field input">
                        <label>Last Name</label>
                        <input type="text" name="lname" placeholder="Enter last name" required>
                    </div>
                </div>
                <div class="field input">
                    <label>Email Address</label>
                    <input type="text" name="email" placeholder="Enter email" required>
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input id="p1" type="password" name="password" placeholder="Enter password" required>
                    <i id="i1" class="fa fa-eye" aria-hidden="true"></i>
                </div>
                <div class="field input">
                    <label>Confirm Password</label>
                    <input id="p2" type="password" name="cpassword" placeholder="Confirm password" required>
                    <i id="i2" class="fas fa-eye"></i>
                </div>
                <div class="field button">
                    <input type="submit" value="Signup">
                </div>
            </form>
            <div class="link">Already signed up? <a href="login.php">Login now</a></div>

        </section>
    </div>
    <script src="static/js/pass-show-hide.js"></script>
    <script src="static/js/signup.js"></script>
</body>
</html>