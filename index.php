<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'includes/head.php' ?>
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/animate.css">
        <title>Junk Broker | Save the Earth</title>
    </head>
    <body>
        <?php 
            if(isset($_GET["errmsg"]))
            if($_GET["errmsg"] == 0)
            {
                echo "
                <div class='alert alert-danger alert-dismissible fade show'>
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                <strong>Error : </strong> Invalid Username or Password
                </div>
                <script>window.history.replaceState(null, '', '/index.php')</script>
                ";
            }
            else if($_GET["errmsg"] == 1)
            {
                echo "
                <div class='alert alert-info alert-dismissible fade show'>
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                <strong>Info : </strong> Session Expired....Please Login Again
                </div>
                <script>window.history.replaceState(null, '', '/index.php')</script>
                ";
            }
            else if($_GET["errmsg"] == 2)
            {
                echo "
                <div class='alert alert-danger alert-dismissible fade show'>
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                <strong>Error : </strong> Invalid FirstName
                </div>
                <script>window.history.replaceState(null, '', '/index.php')</script>
                ";
            }
            else if($_GET["errmsg"] == 4)
            {
                echo "
                <div class='alert alert-danger alert-dismissible fade show'>
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                <strong>Error : </strong> Invalid Email ID
                </div>
                <script>window.history.replaceState(null, '', '/index.php')</script>
                ";
            }
            else if($_GET["errmsg"] == 5)
            {
                echo "
                <div class='alert alert-danger alert-dismissible fade show'>
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                <strong>Error : </strong> Invalid Phone Number
                </div>
                <script>window.history.replaceState(null, '', '/index.php')</script>
                ";
            }
            else if($_GET["errmsg"] == 6)
            {
                echo "
                <div class='alert alert-danger alert-dismissible fade show'>
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                <strong>Error : </strong> File upload failed
                </div>
                <script>window.history.replaceState(null, '', '/index.php')</script>
                ";
            }
            else if($_GET["errmsg"] == 7)
            {
                echo "
                <div class='alert alert-danger alert-dismissible fade show'>
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                <strong>Error : </strong> Please fill all fields of the Signup Form in correct manner.
                </div>
                <script>window.history.replaceState(null, '', '/index.php')</script>
                ";
            }
            else if($_GET["errmsg"] == 9)
            {
                echo "
                <div class='alert alert-danger alert-dismissible fade show'>
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                <strong>Error : </strong> Only 'jpg','png','jpeg','gif','pdf','mp4' file formats are allowed.
                </div>
                <script>window.history.replaceState(null, '', '/index.php')</script>
                ";
            }
            else if($_GET["errmsg"] == 10)
            {
                echo "
                <div class='alert alert-success alert-dismissible fade show'>
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                <strong>Info : </strong> Request Created Successfully.
                </div>
                <script>window.history.replaceState(null, '', '/index.php')</script>
                ";
            }
            else if($_GET["errmsg"] == 11)
            {
                echo "
                <div class='alert alert-danger alert-dismissible fade show'>
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                <strong>Error : </strong> No Records Found.
                </div>
                <script>window.history.replaceState(null, '', '/index.php')</script>
                ";
            }
        ?>
        <?php $page='Home'; include 'includes/navbar.php' ?>
        <?php $page='Home'; include 'includes/home.php' ?>
        <footer class="footerContainer">
            <div class="container-fluid">
                <a class="footerImage" href="../index.php">
                    <img src="../img/JunkBroker_Logo.svg" alt="Junk Broker Logo" style="width:15em;"> 
                </a>
            </div>
            <div class="footerContentContainer">
                <div class="locationContainer">
                    <h4 class="locationText">Locations</h4>
                    <p class="locations">San Jose</p>
                    <p class="locations">San Francisco</p>
                </div>
                <div class="footerContacts">
                    <h4 class="contactsText">Contact Us</h4>
                    <p class="emailId">junkbroker272@gmail.com</p>
                    <p class="phnNo">(925)733-9906</p>
                </div>
            </div>
        </footer>
        <script>
            $('.datepicker').datepicker();

            $("#scrollBtn").click(function(){
                $("html,body").animate({
                    scrollTop:$("#reqForm").offset().top - 140
                },100);
            });
            $("#scrollBtn1").click(function(){
                $("html,body").animate({
                    scrollTop:$("#reqForm").offset().top - 140
                },100);
            });
            $("#scrollBtn2").click(function(){
                $("html,body").animate({
                    scrollTop:$("#whoarewe").offset().top - 100
                },100);
            });
        </script>
        <?php include 'includes/login.php' ?>
        <?php include 'includes/track.php' ?>
    </body>
</html>