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
        <h1 class="secureWelcome">Hello, <?php echo $_SESSION["user"]?></h1>
        <br/>
        <?php 
            $sql = "SELECT * FROM Requests";
            $result = mysqli_query($conn, $sql);

            echo "<p class='simpleText'>Total Requests are: ";
            echo mysqli_num_rows($result);
            echo "</p>";

            if(mysqli_num_rows($result) > 0)
            {
                echo "<table class='table table-bordered'>
                <thead>
                    <tr>
                            <th>Request ID</th>
                            <th>Customer Name</th>
                            <th>Customer EmailID</th>
                            <th>Customer Phone</th>
                            <th>Customer Location</th>
                            <th>Customer Address</th>
                            <th>Request Picture</th>
                            <th>Request Comments</th>
                            <th>Requested Date</th>
                            <th>Requested Time</th>
                    </tr>
                </thead>
                <tbody>";
                $cnt = 0;
                while($row = mysqli_fetch_assoc($result)){
                    $cnt++;
                    echo "<tr>";
                        echo "<td>";
                            echo $row["RequestId"];
                        echo "</td>";
                        echo "<td>";
                            echo $row["CustomerName"];
                        echo "</td>";
                        echo "<td>";
                            echo $row["CustomerEmail"];
                        echo "</td>";
                        echo "<td>";
                            echo $row["CustomerPhone"];
                        echo "</td>";
                        echo "<td>";
                            echo $row["CustomerLocation"];
                        echo "</td>";
                        echo "<td>";
                            echo $row["CustomerAddress"];
                        echo "</td>";
                        echo "<td>";
                            //echo $row["RequestFileName"];
                            echo "<a class='viewImageLink' data-bs-toggle='modal' data-bs-target='#ImageModal".$cnt."'>View File</a>";
                            echo "
                                <div class='modal fade' id='ImageModal".$cnt."'>
                                    <div class='modal-dialog modal-dialog-centered'>
                                        <div class='modal-content'>

                                        <div class='modal-header'>
                                            <h4 class='modal-title'>Request Picture</h4>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class='modal-body'>";
                                            $pieces = explode(".",$row["RequestFileName"]);
                                            if($pieces[1] == "mp4")
                                            {
                                                echo "<video width='460' controls>
                                                <source src='uploads/".$row["RequestFileName"]."'type='video/mp4'>";
                                            }
                                            else
                                            {
                                                echo "<img src='uploads/".
                                                $row["RequestFileName"]."'width='460' height='500'/>";
                                            }
                                        echo "</div>
                                    </div>
                                </div>
                            ";
                        echo "</td>";
                        echo "<td>";
                            echo $row["RequestComments"];
                        echo "</td>";
                        echo "<td>";
                            echo $row["RequestDate"];
                        echo "</td>";
                        echo "<td>";
                            echo $row["RequestTime"];
                        echo "</td>";
                    echo "</tr>";
                }
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
    <script>
        setTimeout(function () {
            window.location.href= '../index.php?errmsg=1'; // the redirect goes here

            },<?php echo $timeoutInSec*1000 ?>);
    </script>  
</body>