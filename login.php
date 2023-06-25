<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){ //if user is logged in
        header("location: users.php");
    }
?>
<?php include_once "header.php"; ?>
<body>
    <div class="wrapper">
        <section class="form login">
            <header>Realtime chat App</header>
            <form action="#">
                <div class="error-text"></div>
                <div class="field input">
                    <label>Email Address</label>
                    <input type="text" name="email" placeholder="Enter your email">
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input id="p1" type="password" name="password" placeholder="Enter your password">
                    <i id="i1" class="fas fa-eye"></i>
                </div>
                <div class="field button">
                    <input type="submit" value="Login">
                </div>
            </form>
            <div class="link">Not yet signed up? <a href="signup.php">Signup now</a></div>

        </section>
    </div>
    <script src="static/js/pass-show-hide.js"></script>
    <script src="static/js/login.js"></script>
</body>
</html>