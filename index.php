<?php include_once "header.php"; ?>
<body id="index">
    <section class="header-wrapper">
        <nav>
            <a href="/" class="navbar-brand">SayHii</a>
            <ul id="start">
                <li><a href="login.php">Login</a></li>
                <li><a href="signup.php">Signup</a></li>
            </ul>
            <div class="nav-links" id="navLinks">
                <i class="fas fa-arrow-right" id="hm"></i>
                <div class="nav-btn">
                    <ul>
                        <li><a href="#">Features</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Help</a></li>
                    </ul>
                </div>
                <div class="st-btn">
                    <ul>
                        <li><a href="login.php" id="login1">Login</a></li>
                        <li><a href="signup.php" id="signup1">Signup</a></li>
                    </ul>
                </div>
            </div>
            <i class="fas fa-bars" id="sm"></i>
        </nav>
        <div class="welcome">
            <h2>Realtime chat app</h2>
            <P>Completely free chatting website without a real account.<br>Chat for free, no real account needed</P>
            <a href="signup.php" id="signup">Get started</a>
        </div>
    </section>
    <section class="footer">
        <div class="footer-bottom">
            <p>&copy; SayHii <?php echo date("Y");?>. By LearnTech.</p>
        </div>
    </section>
    <script src="static/js/index.js"></script>
</body>
</html>
