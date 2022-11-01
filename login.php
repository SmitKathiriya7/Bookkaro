<?php

// if($_SERVER['REQUEST_METHOD']=='POST')
if(isset($_REQUEST['submit']))
{
    $email =  $_REQUEST['mail'];
    $cpass = $_REQUEST['fcpass'];
   
    $server ="localhost";
    $user="root";
    $password="";
    $database="booking";
    $conn =mysqli_connect($server,$user,$password,$database);
    // if(!$conn)
    // {
    //     die("did not connect" . mysql_connect_error());
    // }
    // else{
    //     $sql="SELECT * FROM `user_details`";
    //     $result=mysqli_query($conn,$sql);
    //     if(mysqli_num_rows($result)>0);{
    //       $row=mysqli_fetch_assoc($result);
    //        if($row){
    //         $email  = $row['mail'];
    //         $cpass  = $row['fcpass'];
    //        }
    //        header ("location:home.php");
      
        while($data = mysqli_fetch_assoc($result)){
          static $count=0;
         
            if($email==$data['mail'] && $cpass==$data['fcpass']){

              $sql="SELECT  \`Email`, `User_Password` FROM `user_details` WHERE 1";
              $result=mysqli_query($conn,$sql);
              $ro=mysqli_fetch_assoc($result);
              include('./homePage.html'); 
              break;
            }
            
            $count++;
            if(!$count==$num)
            {
                
                echo  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Fail</strong> Please check your email and password again.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
                
            }
            }
        }
      
?>
<!-- </body>
</html> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/login.css">
</head>

<body>
    <div class="main-form">
        <form>
            <h2 id="heading">Login Now</h2>
            <div class="input-main">
                <div class="input">
                    <label for="Email" id="label"><span>Email Address</span></label>
                    <input type="email" class="input-box" id="Email" placeholder="your email">
                </div>
                <div class="note">We'll never share your email with anyone else.</div>
                <div class="input">
                    <label for="Password" id="label"><span>Password </span> </label>
                    <input type="password" class="input-box" id="Password" placeholder="enter password">
                </div>
             </div>


                <a href="#" class="fp">Forgot Password ?</a>
                <button type="button" class="signup-btn">Login</button>
                <hr>
                <p class="or">OR</p>
                <p class="log_in-main">Don't have an account ?<a href="/signup.html" class="log_in">Sign Up</a></p>
        </form>
    </div>

</body>
</html>