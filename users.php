<?php 
    session_start();
    if(!isset($_SESSION['unique_id'])){
        header("location: login.php");
    }
?>
<?php include_once "header.php"; ?>
<body>
    <div class="wrapper">
        <section class="users">
            <header>
                <?php 
                   include_once "php/config.php";
                   $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
                   if(mysqli_num_rows($sql) > 0){
                      $row = mysqli_fetch_assoc($sql);
                   } 
                ?>
                <div class="content">
                    <img src="php/images/profiles/<?php echo $row['img']?>" alt="">
                    <div class="details">
                        <span><?php echo $row['fname'] . " " . $row['lname'] ?></span>
                        <p>You</p>
                    </div>
                </div>
                <a href="setting.php" id="setting"><i class="fas fa-cog" aria-hidden="true"></i></a>
            </header>
            <div class="search">
                <input type="text" placeholder="Enter name to search...">
            </div>
            <div class="users-list">
                
            </div>
        </section>
    </div>
    <script src="javascript/users.js"></script>
</body>
</html>