<nav class="navbar navbar-expand-sm fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand animate__animated animate__slideInDown" href="../index.php">
            <img src="../img/JunkBroker_Logo.svg" alt="Junk Broker Logo" style="width:15em;"> 
        </a>
        <ul class="navbar-nav">
        <?php
            if(isset($_SESSION["isAdmin"]))
            {
                if($_SESSION["isAdmin"])
                {
                    echo "<li class='nav-item'>
                            <a class='nav-link' 
                            href='logout.php'>Logout</a>
                        </li>";
                }
            }
                else
                {
                    echo "<li class='nav-item'>
                    <a class='nav-link' href= ";
                    if($page=='Home')
                    {
                        echo 'index.php';
                    }
                    else
                    {
                        echo '../index.php';
                    }
                    echo ">Home</a>";
                    if($page == 'Home')
                    {
                        echo "
                        <li class='nav-item'>
                            <a class='nav-link exploreBtn' id='scrollBtn2' style='cursor:pointer'>Who are we</a>
                        </li>";
                    }
                    echo "<li class='nav-item'>
                    <a class='nav-link' href= ";
                    if($page != 'Home') 
                    { 
                        echo 'about.php';
                    } 
                    else 
                    { 
                        echo 'includes/about.php';
                    }
                    echo ">What we Recycle</a>
                </li>";
                if($page == 'Home')
                {
                    echo "
                    <li class='nav-item'>
                        <a class='nav-link exploreBtn' id='scrollBtn' style='cursor:pointer'>Book Now</a>
                    </li>
                    ";
                }
                echo
                "<li class='nav-item'>
                    <a class='nav-link' href='#'>(925)733-9906</a>
                </li>";
                }
    
        
            /* <li class="nav-item">
                <a class="nav-link" href=
                <?php 
                    if(isset($_SESSION["isAdmin"]))
                    {
                        if($_SESSION["isAdmin"])
                        {
                            echo 'securesection.php';
                        }
                    }
                    else
                    {
                        echo '../index.php';
                    }
                ?>
                >Home</a>
            <li class="nav-item">
                <a class="nav-link" href=<?php if($page != 'Home') { echo 'about.php';} else { echo 'includes/about.php';}?>>What we Recycle</a>
            </li>
            <li class="nav-item">
                <div class="dropdown">
                    <a type="button" class="nav-link btn dropdown-toggle" data-bs-toggle="dropdown">
                        Locations
                    </a>
                    <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="includes/sanjose.php">San Jose</a></li>
                    <li><a class="dropdown-item" href="#">San Francisco</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link exploreBtn" id="scrollBtn" style="cursor:pointer">Book Now</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href='includes/contacts.php'>(925)733-9906</a>
            </li>
            <?php
                if(isset($_SESSION["isAdmin"]))
                {
                    if($_SESSION["isAdmin"])
                    {
                        echo "<li class='nav-item'>
                            <a class='nav-link' 
                            href='logout.php'>Logout</a>
                        </li>";
                    }
                }
            ?> */
            ?>
        </ul>
    </div>
</nav>