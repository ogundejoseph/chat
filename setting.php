<?php 
    session_start();
    if(!isset($_SESSION['unique_id'])){
        header("location: login.php");
    }
?>
<?php include_once "header.php"; ?>
<body>
    <div class="wrapper">
        <section class="form setting">  
            <header>
            <?php 
                include_once "php/config.php";
                $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
                if(mysqli_num_rows($sql) > 0){
                    $row = mysqli_fetch_assoc($sql);
                } 
            ?>
            <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <p>Settings</p>
            </header>
            <form action="#" enctype="multipart/form-data" autocomplete="off">
                <div class="error-text"></div>
                <div class="setting-area">
                    <p><b>>>Update Name</b></p>
                    <div class="name-details">    
                        <div class="field-input">
                            <label>First Name</label>
                            <input type="text" name="nfname" placeholder="Enter new first name">
                        </div>
                        <div class="field-input">
                            <label>Last Name</label>
                            <input type="text" name="nlname" placeholder="Enter new last name">
                        </div>
                    </div>
                    <p><b>>>Update Password</b></p>
                    <div class="password-details">      
                        <div class="field-input">
                            <label>Current Password</label>
                            <input type="text" name="cpassword" placeholder="Enter current password">
                        </div>
                        <div class="field-input">
                            <label>New Password</label>
                            <input type="text" name="npassword" placeholder="Enter new password">
                        </div>
                    </div>
                    <p><b>>>Update Profile</b></p>
                    <div class="profile-image">
                        <div class="field image">
                            <input type="file" name="image">
                        </div>
                        <div class="del-image">
                            <input id="delImage" type="submit" value="Delete Profile">
                        </div>
                    </div>
                    <div class="submit-button">
                        <input id="submit" type="submit" value="Submit changes">
                    </div>
                    <div class="account-details">
                        <div class="logout">
                            <a href="php/logout.php?logout_id=<?php echo $row['unique_id'] ?>" id="logout">Logout</a>
                        </div>
                        <div class="del-acc">
                            <a href="php/exit.php?exit_id=<?php echo $row['unique_id'] ?>" id="del-acc">Delete Account</a>
                        </div>
                    </div>
                </div>
            </form>
        </section>   
    </div>
    <script src="static/js/setting.js"></script>
    <script src="static/js/profile-del.js"></script>
</body>
</html>