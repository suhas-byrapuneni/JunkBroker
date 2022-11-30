<?php include 'header.php'; include_once 'dbconnect.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.php' ?>
    <title>Secure | Junk Broker</title>
</head>
<body class="securePage">
    <?php $page='Secure'; $_SESSION["isAdmin"] = true; include 'navbar.php' ?>
    <div class="secureContainer">
        <h1 class="secureWelcome">Hello, <?php echo "Junk Broker"?></h1>
        <br/>
        <div class="container mt-6 viewContainer1">
            <a class='inProcessBtn' data-bs-toggle='modal' data-bs-target='#inProcessModal'>View Pending Requests</a>
            <a class='acceptedBtn' data-bs-toggle='modal' data-bs-target='#acceptedModal'>View Accepted Requests</a>
            <a class='rejectedBtn' data-bs-toggle='modal' data-bs-target='#rejectedModal'>View Rejected Requests</a>
            <a class='completedBtn' data-bs-toggle='modal' data-bs-target='#completedModal'>View Completed Requests</a>
        </div>
        <?php 
            $sql = "SELECT * FROM Requests";
            $result = mysqli_query($conn, $sql);
            //$conn->close();

            echo "<p class='simpleText'>Total Requests: ";
            echo mysqli_num_rows($result);
            echo "</p>";

            if(mysqli_num_rows($result) > 0)
            {
                echo "<div class='row'>\n";
                $cnt = 0;
                while($row = mysqli_fetch_assoc($result))
                {
                    $cnt++;
                    echo "<div class='col-xl-4 card mycard".$cnt."'>\n";
                    $pieces = explode(".",$row["RequestFileName"]);
                    if($pieces[1] == "mp4")
                    {
                        echo "<video class='card-img-top' width='460' controls>
                        <source src='uploads/".$row["RequestFileName"]."'type='video/mp4'></video>\n";
                    }
                    else
                    {
                        echo "<img class='card-img-top' src='uploads/".
                        $row["RequestFileName"]."'width='460'/>\n";
                    }
                    echo "<div class='card-body'>\n";
                    echo "<h4 class='card-title'>".$row["CustomerName"]."</h4>\n";
                    echo "<p class='card-text'>".$row["CustomerEmail"]."</p>\n";
                    echo "<p class='card-text'><span class='custPhone'>Phone: </span>".$row["CustomerPhone"]."</p>\n";
                    echo "<p class='card-text'><span class='custPhone'>Location: </span>".$row["CustomerLocation"]."</p>\n";
                    echo "<p class='card-text'><span class='custPhone'>Address: </span>".$row["CustomerAddress"]."</p>\n";
                    echo "<p class='card-text'><span class='custPhone'>Comments: </span>".$row["RequestComments"]."</p>\n";
                    echo "<p class='card-text'><span class='custPhone'>Pick up date: </span>".$row["RequestDate"]."</p>\n";
                    echo "<p class='card-text'><span class='custPhone'>Pick up time: </span>".$row["RequestTime"]."</p>\n";
                    echo "<p class='card-text'><span class='custStatus'>Status: </span><span class='statusText'>".$row["RequestStatus"]."</span></p>\n";
                    echo "<div class='actionBtnContainer'>\n";
                    //$newName = handleSpaces($row["productName"]);
                    echo "<form method='post'>";
                    if($row["RequestStatus"] == "In Process")
                    echo "<button type='submit' class='mycardbutton".$cnt." btn btn-success' name='acceptbutton".$cnt."'>Accept</button>";

                    if($row["RequestStatus"] == "In Process")
                    echo "<button type='submit' class='mycardbutton".$cnt." btn btn-danger' name='rejectbutton".$cnt."'>Reject</button>";

                    if($row["RequestStatus"] != "In Process" && $row["RequestStatus"] != "Rejected" && $row["RequestStatus"] != "Completed")
                    echo "<button type='submit' class='mycardbutton".$cnt." btn btn-primary' name='donebutton".$cnt."'>Pick up Done?</button>";

                    echo "</form>";
                    if(array_key_exists('acceptbutton'.$cnt, $_POST))
                    {
                        $sql1 = "UPDATE Requests SET RequestStatus = 'Accepted' WHERE RequestId = ".$cnt;
                        mysqli_query($conn, $sql1);
                        $conn->close();
                        header("location:securesection.php");
                    }
                    if(array_key_exists('rejectbutton'.$cnt, $_POST))
                    {
                        $sql2 = "UPDATE Requests SET RequestStatus = 'Rejected' WHERE RequestId = ".$cnt;
                        mysqli_query($conn, $sql2);
                        $conn->close();
                        header("location:securesection.php");
                    }
                    if(array_key_exists('donebutton'.$cnt, $_POST))
                    {
                        $sql3 = "UPDATE Requests SET RequestStatus = 'Completed' WHERE RequestId = ".$cnt;
                        mysqli_query($conn, $sql3);
                        $conn->close();
                        header("location:securesection.php");
                    }
                    echo "</div>";
                    echo "</div>\n";
                    echo "</div>\n\n";
                }
                echo "</div>\n";
            }
            else
            {
                echo "
                <div class='alert alert-danger alert-dismissible fade show'>
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                <strong>Error : </strong> No records found...
                </div>
                <script>window.history.replaceState(null, '', 'users.php')</script>
                ";
            }
        ?>
    </div>

    <!-- The Modal -->
    <div class="modal fade modal-xl" id="inProcessModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">List of Pending Requests</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body container">
            <?php
                echo "<div class='row'>\n";
                $result = $conn->query("SELECT * FROM Requests where RequestStatus = 'In Process';");
                while($row = mysqli_fetch_assoc($result))
                {
                    $cnt++;
                    echo "<div class='col-xl-6 card mycard".$row["RequestId"]."'>\n";
                    $pieces = explode(".",$row["RequestFileName"]);
                    if($pieces[1] == "mp4")
                    {
                        echo "<video class='card-img-top' width='300' controls>
                        <source src='uploads/".$row["RequestFileName"]."'type='video/mp4'></video>\n";
                    }
                    else
                    {
                        echo "<img class='card-img-top' src='uploads/".
                        $row["RequestFileName"]."'width='300'/>\n";
                    }
                    echo "<div class='card-body'>\n";
                    echo "<h4 class='card-title'>".$row["CustomerName"]."</h4>\n";
                    echo "<p class='card-text'>".$row["CustomerEmail"]."</p>\n";
                    echo "<p class='card-text'><span class='custPhone'>Phone: </span>".$row["CustomerPhone"]."</p>\n";
                    echo "<p class='card-text'><span class='custPhone'>Location: </span>".$row["CustomerLocation"]."</p>\n";
                    echo "<p class='card-text'><span class='custPhone'>Address: </span>".$row["CustomerAddress"]."</p>\n";
                    echo "<p class='card-text'><span class='custPhone'>Comments: </span>".$row["RequestComments"]."</p>\n";
                    echo "<p class='card-text'><span class='custPhone'>Pick up date: </span>".$row["RequestDate"]."</p>\n";
                    echo "<p class='card-text'><span class='custPhone'>Pick up time: </span>".$row["RequestTime"]."</p>\n";
                    echo "<p class='card-text'><span class='custStatus'>Status: </span><span class='statusText'>".$row["RequestStatus"]."</span></p>\n";
                    echo "<div class='actionBtnContainer'>\n";
                    echo "<form method='post'>";
                    if($row["RequestStatus"] == "In Process")
                    echo "<button type='submit' class='mycardbutton".$row["RequestId"]." btn btn-success' name='acceptbutton".$row["RequestId"]."'>Accept</button>";

                    if($row["RequestStatus"] == "In Process")
                    echo "<button type='submit' class='mycardbutton".$row["RequestId"]." btn btn-danger' name='rejectbutton".$row["RequestId"]."'>Reject</button>";

                    if($row["RequestStatus"] != "In Process" && $row["RequestStatus"] != "Rejected" && $row["RequestStatus"] != "Completed")
                    echo "<button type='submit' class='mycardbutton".$row["RequestId"]." btn btn-primary' name='donebutton".$row["RequestId"]."'>Pick up Done?</button>";

                    echo "</form>";
                    if(array_key_exists('acceptbutton'.$row["RequestId"], $_POST))
                    {
                        $sql1 = "UPDATE Requests SET RequestStatus = 'Accepted' WHERE RequestId = ".$row["RequestId"];
                        mysqli_query($conn, $sql1);
                        $conn->close();
                        header("location:securesection.php");
                    }
                    if(array_key_exists('rejectbutton'.$row["RequestId"], $_POST))
                    {
                        $sql2 = "UPDATE Requests SET RequestStatus = 'Rejected' WHERE RequestId = ".$row["RequestId"];
                        mysqli_query($conn, $sql2);
                        $conn->close();
                        header("location:securesection.php");
                    }
                    if(array_key_exists('donebutton'.$row["RequestId"], $_POST))
                    {
                        $sql3 = "UPDATE Requests SET RequestStatus = 'Completed' WHERE RequestId = ".$row["RequestId"];
                        mysqli_query($conn, $sql3);
                        $conn->close();
                        header("location:securesection.php");
                    }
                    echo "</div>";
                    echo "</div>\n";
                    echo "</div>\n\n";
                }
                echo "</div>\n";
            ?>
        </div>
        </div>
    </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade modal-xl" id="acceptedModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">List of Accepted Requests</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body container">
            <?php
                echo "<div class='row'>\n";
                $result = $conn->query("SELECT * FROM Requests where RequestStatus = 'Accepted';");
                while($row = mysqli_fetch_assoc($result))
                {
                    $cnt++;
                    echo "<div class='col-xl-6 card mycard".$row["RequestId"]."'>\n";
                    $pieces = explode(".",$row["RequestFileName"]);
                    if($pieces[1] == "mp4")
                    {
                        echo "<video class='card-img-top' width='300' controls>
                        <source src='uploads/".$row["RequestFileName"]."'type='video/mp4'></video>\n";
                    }
                    else
                    {
                        echo "<img class='card-img-top' src='uploads/".
                        $row["RequestFileName"]."'width='300'/>\n";
                    }
                    echo "<div class='card-body'>\n";
                    echo "<h4 class='card-title'>".$row["CustomerName"]."</h4>\n";
                    echo "<p class='card-text'>".$row["CustomerEmail"]."</p>\n";
                    echo "<p class='card-text'><span class='custPhone'>Phone: </span>".$row["CustomerPhone"]."</p>\n";
                    echo "<p class='card-text'><span class='custPhone'>Location: </span>".$row["CustomerLocation"]."</p>\n";
                    echo "<p class='card-text'><span class='custPhone'>Address: </span>".$row["CustomerAddress"]."</p>\n";
                    echo "<p class='card-text'><span class='custPhone'>Comments: </span>".$row["RequestComments"]."</p>\n";
                    echo "<p class='card-text'><span class='custPhone'>Pick up date: </span>".$row["RequestDate"]."</p>\n";
                    echo "<p class='card-text'><span class='custPhone'>Pick up time: </span>".$row["RequestTime"]."</p>\n";
                    echo "<p class='card-text'><span class='custStatus'>Status: </span><span class='statusText'>".$row["RequestStatus"]."</span></p>\n";
                    echo "<div class='actionBtnContainer'>\n";
                    echo "<form method='post'>";
                    if($row["RequestStatus"] == "In Process")
                    echo "<button type='submit' class='mycardbutton".$row["RequestId"]." btn btn-success' name='acceptbutton".$row["RequestId"]."'>Accept</button>";

                    if($row["RequestStatus"] == "In Process")
                    echo "<button type='submit' class='mycardbutton".$row["RequestId"]." btn btn-danger' name='rejectbutton".$row["RequestId"]."'>Reject</button>";

                    if($row["RequestStatus"] != "In Process" && $row["RequestStatus"] != "Rejected" && $row["RequestStatus"] != "Completed")
                    echo "<button type='submit' class='mycardbutton".$row["RequestId"]." btn btn-primary' name='donebutton".$row["RequestId"]."'>Pick up Done?</button>";

                    echo "</form>";
                    if(array_key_exists('acceptbutton'.$row["RequestId"], $_POST))
                    {
                        $sql1 = "UPDATE Requests SET RequestStatus = 'Accepted' WHERE RequestId = ".$row["RequestId"];
                        mysqli_query($conn, $sql1);
                        $conn->close();
                        header("location:securesection.php");
                    }
                    if(array_key_exists('rejectbutton'.$row["RequestId"], $_POST))
                    {
                        $sql2 = "UPDATE Requests SET RequestStatus = 'Rejected' WHERE RequestId = ".$row["RequestId"];
                        mysqli_query($conn, $sql2);
                        $conn->close();
                        header("location:securesection.php");
                    }
                    if(array_key_exists('donebutton'.$row["RequestId"], $_POST))
                    {
                        $sql3 = "UPDATE Requests SET RequestStatus = 'Completed' WHERE RequestId = ".$row["RequestId"];
                        mysqli_query($conn, $sql3);
                        $conn->close();
                        header("location:securesection.php");
                    }
                    echo "</div>";
                    echo "</div>\n";
                    echo "</div>\n\n";
                }
                echo "</div>\n";
            ?>
        </div>
        </div>
    </div>
    </div>

     <!-- The Modal -->
     <div class="modal fade modal-xl" id="rejectedModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">List of Rejected Requests</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body container">
            <?php
                echo "<div class='row'>\n";
                $result = $conn->query("SELECT * FROM Requests where RequestStatus = 'Rejected';");
                while($row = mysqli_fetch_assoc($result))
                {
                    $cnt++;
                    echo "<div class='col-xl-6 card mycard".$row["RequestId"]."'>\n";
                    $pieces = explode(".",$row["RequestFileName"]);
                    if($pieces[1] == "mp4")
                    {
                        echo "<video class='card-img-top' width='400' controls>
                        <source src='uploads/".$row["RequestFileName"]."'type='video/mp4'></video>\n";
                    }
                    else
                    {
                        echo "<img class='card-img-top' src='uploads/".
                        $row["RequestFileName"]."'width='300'/>\n";
                    }
                    echo "<div class='card-body'>\n";
                    echo "<h4 class='card-title'>".$row["CustomerName"]."</h4>\n";
                    echo "<p class='card-text'>".$row["CustomerEmail"]."</p>\n";
                    echo "<p class='card-text'><span class='custPhone'>Phone: </span>".$row["CustomerPhone"]."</p>\n";
                    echo "<p class='card-text'><span class='custPhone'>Location: </span>".$row["CustomerLocation"]."</p>\n";
                    echo "<p class='card-text'><span class='custPhone'>Address: </span>".$row["CustomerAddress"]."</p>\n";
                    echo "<p class='card-text'><span class='custPhone'>Comments: </span>".$row["RequestComments"]."</p>\n";
                    echo "<p class='card-text'><span class='custPhone'>Pick up date: </span>".$row["RequestDate"]."</p>\n";
                    echo "<p class='card-text'><span class='custPhone'>Pick up time: </span>".$row["RequestTime"]."</p>\n";
                    echo "<p class='card-text'><span class='custStatus'>Status: </span><span class='statusText'>".$row["RequestStatus"]."</span></p>\n";
                    echo "<div class='actionBtnContainer'>\n";
                    echo "<form method='post'>";
                    if($row["RequestStatus"] == "In Process")
                    echo "<button type='submit' class='mycardbutton".$row["RequestId"]." btn btn-success' name='acceptbutton".$row["RequestId"]."'>Accept</button>";

                    if($row["RequestStatus"] == "In Process")
                    echo "<button type='submit' class='mycardbutton".$row["RequestId"]." btn btn-danger' name='rejectbutton".$row["RequestId"]."'>Reject</button>";

                    if($row["RequestStatus"] != "In Process" && $row["RequestStatus"] != "Rejected" && $row["RequestStatus"] != "Completed")
                    echo "<button type='submit' class='mycardbutton".$row["RequestId"]." btn btn-primary' name='donebutton".$row["RequestId"]."'>Pick up Done?</button>";

                    echo "</form>";
                    if(array_key_exists('acceptbutton'.$row["RequestId"], $_POST))
                    {
                        $sql1 = "UPDATE Requests SET RequestStatus = 'Accepted' WHERE RequestId = ".$row["RequestId"];
                        mysqli_query($conn, $sql1);
                        $conn->close();
                        header("location:securesection.php");
                    }
                    if(array_key_exists('rejectbutton'.$row["RequestId"], $_POST))
                    {
                        $sql2 = "UPDATE Requests SET RequestStatus = 'Rejected' WHERE RequestId = ".$row["RequestId"];
                        mysqli_query($conn, $sql2);
                        $conn->close();
                        header("location:securesection.php");
                    }
                    if(array_key_exists('donebutton'.$row["RequestId"], $_POST))
                    {
                        $sql3 = "UPDATE Requests SET RequestStatus = 'Completed' WHERE RequestId = ".$row["RequestId"];
                        mysqli_query($conn, $sql3);
                        $conn->close();
                        header("location:securesection.php");
                    }
                    echo "</div>";
                    echo "</div>\n";
                    echo "</div>\n\n";
                }
                echo "</div>\n";
            ?>
        </div>
        </div>
    </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade modal-xl" id="completedModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">List of Completed Requests</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body container">
            <?php
                echo "<div class='row'>\n";
                $result = $conn->query("SELECT * FROM Requests where RequestStatus = 'Completed';");
                while($row = mysqli_fetch_assoc($result))
                {
                    $cnt++;
                    echo "<div class='col-xl-6 card mycard".$row["RequestId"]."'>\n";
                    $pieces = explode(".",$row["RequestFileName"]);
                    if($pieces[1] == "mp4")
                    {
                        echo "<video class='card-img-top' width='400' controls>
                        <source src='uploads/".$row["RequestFileName"]."'type='video/mp4'></video>\n";
                    }
                    else
                    {
                        echo "<img class='card-img-top' src='uploads/".
                        $row["RequestFileName"]."'width='300'/>\n";
                    }
                    echo "<div class='card-body'>\n";
                    echo "<h4 class='card-title'>".$row["CustomerName"]."</h4>\n";
                    echo "<p class='card-text'>".$row["CustomerEmail"]."</p>\n";
                    echo "<p class='card-text'><span class='custPhone'>Phone: </span>".$row["CustomerPhone"]."</p>\n";
                    echo "<p class='card-text'><span class='custPhone'>Location: </span>".$row["CustomerLocation"]."</p>\n";
                    echo "<p class='card-text'><span class='custPhone'>Address: </span>".$row["CustomerAddress"]."</p>\n";
                    echo "<p class='card-text'><span class='custPhone'>Comments: </span>".$row["RequestComments"]."</p>\n";
                    echo "<p class='card-text'><span class='custPhone'>Pick up date: </span>".$row["RequestDate"]."</p>\n";
                    echo "<p class='card-text'><span class='custPhone'>Pick up time: </span>".$row["RequestTime"]."</p>\n";
                    echo "<p class='card-text'><span class='custStatus'>Status: </span><span class='statusText'>".$row["RequestStatus"]."</span></p>\n";
                    echo "<div class='actionBtnContainer'>\n";
                    echo "<form method='post'>";
                    if($row["RequestStatus"] == "In Process")
                    echo "<button type='submit' class='mycardbutton".$row["RequestId"]." btn btn-success' name='acceptbutton".$row["RequestId"]."'>Accept</button>";

                    if($row["RequestStatus"] == "In Process")
                    echo "<button type='submit' class='mycardbutton".$row["RequestId"]." btn btn-danger' name='rejectbutton".$row["RequestId"]."'>Reject</button>";

                    if($row["RequestStatus"] != "In Process" && $row["RequestStatus"] != "Rejected" && $row["RequestStatus"] != "Completed")
                    echo "<button type='submit' class='mycardbutton".$row["RequestId"]." btn btn-primary' name='donebutton".$row["RequestId"]."'>Pick up Done?</button>";

                    echo "</form>";
                    if(array_key_exists('acceptbutton'.$row["RequestId"], $_POST))
                    {
                        $sql1 = "UPDATE Requests SET RequestStatus = 'Accepted' WHERE RequestId = ".$row["RequestId"];
                        mysqli_query($conn, $sql1);
                        $conn->close();
                        header("location:securesection.php");
                    }
                    if(array_key_exists('rejectbutton'.$row["RequestId"], $_POST))
                    {
                        $sql2 = "UPDATE Requests SET RequestStatus = 'Rejected' WHERE RequestId = ".$row["RequestId"];
                        mysqli_query($conn, $sql2);
                        $conn->close();
                        header("location:securesection.php");
                    }
                    if(array_key_exists('donebutton'.$row["RequestId"], $_POST))
                    {
                        $sql3 = "UPDATE Requests SET RequestStatus = 'Completed' WHERE RequestId = ".$row["RequestId"];
                        mysqli_query($conn, $sql3);
                        $conn->close();
                        header("location:securesection.php");
                    }
                    echo "</div>";
                    echo "</div>\n";
                    echo "</div>\n\n";
                }
                echo "</div>\n";
            ?>
        </div>
        </div>
    </div>
    </div>

    <script>
        setTimeout(function () {
            window.location.href= '../index.php?errmsg=1'; // the redirect goes here

            },<?php echo $timeoutInSec*1000 ?>);
    </script>  
</body>