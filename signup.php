<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 //Load Composer's autoloader
 require '12/PHPMailer.php';
 require '12/SMTP.php';
 require '12/Exception.php';

if($_SERVER['REQUEST_METHOD']=='POST' && $_REQUEST['fpass'] == $_REQUEST['fcpass'])
{
    $name = $_REQUEST['fname'];
    $email = $_REQUEST["mail"]; 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }

//     $cpass=mysqli_real_escape_string( $conn,$_POST['fcpass']);
// $cpass=md5($password); 

    $password =$_REQUEST['fpass'];

    $cpass = $_REQUEST['fcpass'];
    // $cpass=mysqli_real_escape_string( $conn,$_POST['fcpass']);
    $cpass = md5($cpass); 

//Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = '21ce054@charusat.edu.in';                     //SMTP username
    $mail->Password   = 'Krunal@1863';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('21ce054@charusat.edu.in', 'Bookkaro.com');
    $mail->addAddress($email);    
  

    //Content
    $mail->isHTML(true);                                  
    $mail->Subject = 'Registration!';
    $mail->Body    = '<b>Your Account Created Successfully..</b><br><br><br>Thanks & Regards, <br> <b>Krunal Kevadiya <br>And from bookkaro .com team, </b><br> Mobail Number: 7046631796 <br>';

    if($mail->send()){
                 echo '<script type="text/javascript">alert("massage sent!")</script>';
        
            }
            else{
                echo '<script type="text/javascript">alert("Try again!")</script>'; 
            }

    



    $server ="localhost";
    $user="root";
    $password="";
    $database="booking";
    $conn =mysqli_connect($server,$user,$password,$database);
    if(!$conn){
        die("did not connect" . mysql_connect_error());
    }
    else{
        $sql="INSERT INTO `user_details`(`name`, `Email` , `User_Password`) VALUES ('$name', '$email' , '$cpass' )";
        $result=mysqli_query($conn,$sql);
        if($result){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success</strong> you have resister success fully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
          $sql="SELECT * FROM `user_details`";
        $result=mysqli_query($conn,$sql);
        $num=mysqli_num_rows($result);


        header("location:login.php");
        }
    }
    
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up </title>

    <link rel="stylesheet" href="signup.css">
</head>

<body onload="generateCaptcha()">
    <form aciton="signup.php" name="myForm" id="submitform" onsubmit="return validateForm()" method="post">
        <h2 id="heading">Signup Now</h2>
        <div class="input-main">
            <div class="input">
                <label for="Full Name" class="label"><span>Full name </span> </label>
                <div class="input_class" id="input_name">
                    <input type="name" name="fname" class="input-box" id="FullName" placeholder="firstname">
                    <span class="formerror"></span>
                </div>
            </div>
            <div class="input">
                <label for="Email" class="label"><span> Email</span></label>
                <div class="input_class" id="input_email">
                    <input type="email" class="input-box" id="Email" placeholder="your email" required pattern="[a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,}">
                    <span class="formerror"></span>
                </div>
            </div>
            <div class="input">
                <label for="phone_number" class="label"><span>Phone number</span></label>
                <div class="input_class" id="input_phone">
                    <input type="tel" name="fphone" maxlength="10" class="input-box" id="phone_number"
                        placeholder="enter your phone number">
                    <span class="formerror"></span>
                </div>
            </div>
            <div class="input">
                <label for="Date" class="label"><span>Birth Date</span></label>
                <div class="input_class" id="input_dob">
                    <input type="date" name="fdate" class="input-box" id="Date" placeholder="dob" max="2021-12-31">
                    <span class="formerror"></span>
                </div>
            </div>
            <div class="input">
                <label for="Password" class="label"><span>Password </span> </label>
                <div class="input_class" id="input_pass">
                    <input type="password" name="fpass" class="input-box" id="Password" placeholder="enter password">
                    <span class="formerror"></span>
                </div>
            </div>
            <div class="input">
                <label for="confirmpassword" class="label"><span> Confirm Password </span></label>
                <div class="input_class" id="input_cpass">
                    <input type="password" name="fcpass" class="input-box" id="confirmpassword"
                        placeholder="confirm password">
                    <span class="formerror"></span>
                </div>
            </div>
            <div class="input capchacenter">
                <div class="input_class" id="input_capcha">
                    <div class="generatecapcha">
                        <input type="text" id="mainCaptcha" class="innergeneratecapcha" />
                        <input type="button" id="change" value="Change" class="innergeneratecapcha"
                            onclick="generateCaptcha();" />
                    </div>
                    <div class="entercapcha">
                        <input type="text" id="txtInput" class="input-box" placeholder="enter capcha" />
                        <span class="formerror"></span>
                    </div>
                </div>
            </div>
        </div>
        <p class="term"><span><input type="checkbox" id="check" required></span> I agree to term services</p>
        <button type="submit" class="signup-btn">Sign Up</button>
        <hr>
        <p class="or">OR</p>
        <p class="log_in-main">Do you have an account ?<a href="/login.html" class="log_in">Log In</a></p>
    </form>
    </div>
</body>
<script src="signup.js"></script>
<script>
    let confirmpassword = document.getElementById("confirmpassword");
    confirmpassword.addEventListener('paste', e => e.preventDefault());
    let txtInput = document.getElementById("txtInput");
    txtInput.addEventListener('paste', e => e.preventDefault());
</script>
                                 
</html>