<?php 
    session_start();
    ob_start();
    include_once 'dbconnect.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';
    // File upload path
    $targetDir = "uploads/";
    $fileName = basename($_FILES["formFileMultiple"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

     if (isset($_POST["Signup"]) && 
        !empty($_POST["fullName"]) && 
        !empty($_POST["email"]) &&
        !empty($_POST["phone"]) 
        //&& !empty($_POST["custLocation"])
        && !empty($_POST["address"])
        //&& !empty($_FILES["formFileMultiple"]["name"])
        && !empty($_POST["comments"])
        && !empty($_POST["startDate"])
        //&& !empty($_POST["pickATime"])
        )
     {
        if(preg_match("/^[0-9]+$/", $_POST["fullName"]))
        {
            header("location: ../index.php?errmsg=2");
            $_SESSION["errmessage"] = "Invalid Name";
            exit;
        }
        else if(!preg_match("/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/", $_POST["email"]))
        {
            header("location: ../index.php?errmsg=4");
            $_SESSION["errmessage"] = "Invalid Email ID";
            exit;
        }
        else if(!preg_match("/^[(][0-9]{3}[)][0-9]{3}-[0-9]{4}$/", $_POST["phone"]))
        {
            header("location: ../index.php?errmsg=5");
            $_SESSION["errmessage"] = "Invalid Phone Number";
            exit;
        }
        else
        {
            // Allow certain file formats
            $allowTypes = array('jpg','png','jpeg','gif','pdf','mp4');
            if(in_array($fileType, $allowTypes))
            {
                // Upload file to server
                if(move_uploaded_file($_FILES["formFileMultiple"]["tmp_name"], $targetFilePath))
                {
                    //Insert user to the DB
                    $sql = "INSERT INTO Requests (CustomerName,CustomerEmail,CustomerPhone,CustomerLocation,CustomerAddress,RequestFileName,RequestComments, RequestDate, RequestTime, RequestStatus) VALUES ('"
                    .$_POST["fullName"]
                    ."', '"
                    .$_POST["email"]
                    ."', '"
                    .$_POST["phone"]
                    ."', '"
                    .$_POST["custLocation"]
                    ."', '"
                    .$_POST["address"]
                    ."', '"
                    .$fileName
                    ."', '"
                    .$_POST["comments"]
                    ."', '"
                    .$_POST["startDate"]
                    ."', '"
                    .$_POST["pickATime"]
                    ."', '"
                    ."In Process"
                    ."')";
                    mysqli_query($conn, $sql);
                    $conn->close();

                    $name = $_POST["fullName"];
                    $tomail = $_POST["email"];
                    $phone = $_POST["phone"];
                    $location = $_POST["custLocation"];
                    $address = $_POST["address"];
                    $comments = $_POST["comments"];
                    $date = $_POST["startDate"];
                    $time = $_POST["pickATime"];

                    //Create an instance; passing `true` enables exceptions
                    $mail = new PHPMailer(true);
                    $mail1 = new PHPMailer(true);
                    try 
                    {
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = 'junkbrokercmpe272@gmail.com';           //SMTP username
                        $mail->Password   = 'hkdzmvlnzmxlpxjm';                     //SMTP password
                        $mail->SMTPSecure = 'ssl';                                  //Enable implicit TLS encryption
                        $mail->Port       = 465;

                        //Send to User
                        $mail->setFrom('junkbrokercmpe272@gmail.com', 'Junk Broker');
                        $mail->addAddress($tomail);                                 //Add a recipient
                        $mail->addBCC('suhasbyrapuneni1@gmail.com');

                        //Content
                        $mail->isHTML(false);                                  //Set email format to HTML
                        $mail->Subject = 'Junk Broker | Request Submit Successfully';
                        $mail->Body    = "Dear ".$name.",\n\nThank you for choosing our company.\nWe will get back to you via email within 24 hours.\n\n\nAdministrator,\nJunk Broker Ltd";

                        $mail->send();

                        $mail1->isSMTP();                                            //Send using SMTP
                        $mail1->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                        $mail1->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail1->Username   = 'junkbrokercmpe272@gmail.com';           //SMTP username
                        $mail1->Password   = 'hkdzmvlnzmxlpxjm';                     //SMTP password
                        $mail1->SMTPSecure = 'ssl';                                  //Enable implicit TLS encryption
                        $mail1->Port       = 465;

                        //Send to Admin
                        $mail1->setFrom('junkbrokercmpe272@gmail.com', 'Junk Broker');
                        $mail1->addAddress('junkbroker272@gmail.com');               //Add a recipient
                        $mail1->addBCC('suhasbyrapuneni1@gmail.com');

                        //Content
                        $mail1->isHTML(true);                                  //Set email format to HTML
                        $mail1->Subject = 'A Request has been raised';
                        $mail1->Body    = 'Dear Administrator,<br><br>A new request has been raised in the portal.<br><br>Here are few details of the request along with media attached below.<br><br><b>Customer Name : </b>'.$name.'<br><b>Customer Email : </b>'.$tomail.'<br><b>Customer Phone Number : </b>'.$phone.'<br><b>Customer Location : </b>'.$location.'<br><b>Customer Address : </b>'.$address.'<br><b>Customer Comments: </b>'.$comments.'<br><b>Requested Pick up date: </b>'.$date.'<br><b>Customer available time: </b>'.$time;

                        //Attachment
                        $mail1->addAttachment('uploads/'.$fileName, $name.'_Junk.'.$fileType);

                        $mail1->send();
                    } 
                    catch (Exception $e) 
                    {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                    header("location:../index.php?errmsg=10");
                }
                else
                {
                    header("location:../index.php?errmsg=6");
                    exit;
                }
            }
            else
            {
                header("location:../index.php?errmsg=9");
                exit;
            }
        }
     }
     else
    {
        header("location: ../index.php?errmsg=7");
        $_SESSION["errmessage"] = "Please fill all fields of the Signup Form in correct manner.";
    }
?>