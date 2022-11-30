<!-- The Modal -->
<?php include_once 'dbconnect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.php' ?>
    <title>Track Request | Junk Broker</title>
</head>
<body class="trackPage">
    <?php $page='Track'; include 'navbar.php' ?>
    <?php
        if(isset($_POST["trackemail"]))
        {
            $trackemail = $_POST["trackemail"];
            $result = $conn->query("SELECT * FROM Requests where CustomerEmail ='".$trackemail."';");
            if(mysqli_num_rows($result) == 0)
            {
                header("location:../index.php?errmsg=11");
                exit;
            }
            else
            {
                echo "<div class='row requestsContainer'>\n";
                while($row = mysqli_fetch_assoc($result))
                {
                    echo "<div class='col-xl-4 requests'>\n";
                    echo "<h3 class='request-text'><span class='custPhone'>Request ID - </span>".$row["RequestId"]."</h3>\n";
                    echo "<p class='request-text'><span class='custPhone'>Phone: </span>".$row["CustomerPhone"]."</p>\n";
                    echo "<p class='request-text'><span class='custPhone'>Location: </span>".$row["CustomerLocation"]."</p>\n";
                    echo "<p class='request-text'><span class='custPhone'>Address: </span>".$row["CustomerAddress"]."</p>\n";
                    echo "<p class='request-text'><span class='custPhone'>Comments: </span>".$row["RequestComments"]."</p>\n";
                    echo "<p class='request-text'><span class='custPhone'>Pick up date: </span>".$row["RequestDate"]."</p>\n";
                    echo "<p class='request-text'><span class='custPhone'>Pick up time: </span>".$row["RequestTime"]."</p>\n";
                    echo "<p class='request-text'><span class='custStatus'>Status: </span><span class='statusText'>".$row["RequestStatus"]."</span></p>\n";
                    echo "</div>";
                }
                echo "</div>";
            }
        }
        else
        {
            header("location:../index.php?errmsg=4");
            exit;
        }
    ?>
</body>