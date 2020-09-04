<!DOCTYPE html >
<?php
session_start();
if(!isset($_SESSION["member_id"]) && $_SESSION["member_id"]==false)
{
    header("Location:http://localhost/carrentalport/index.php");
}
else
{
    $con_table=mysqli_connect("localhost","root","","carentalport");
    $c_id=$_SESSION["member_id"];
}

?>
<html>
    <head>
        <title>CAR RENTAL PORT </title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/user2.css">
        <link href="https://fonts.googleapis.com/css?family=Bungee+Inline|Monoton&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Monoton&display=swap" rel="stylesheet">
        <link rel="icon" type="image/png" sizes="32x32" href="../css/favicon-32x32.png">
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
    <header>
    <div class="topnav">
    <a href="#about">ABOUT</a>
     
     <a href="../admin/admin.php">ADMIN</a>
     <a class="active" href="../users/user.php">USER</a>
     <a  href="../index.php">HOME</a>
   </div>
   <div class="sidenav">
   <a href="../users/user.php"  >Dashboard</a>
  <a href="../users/profile.php" class="active">Profile</a>
  <a href="../users/booking.php">My Booking</a>
  
  <a href="../users/logout.php">Logout</a>
</div>
</header>
<div class="main">
<div id="container" class="content">
                <h1 align="center">My Profile</h1>
                <div class="form">
                <form method="post" action="editprof.php">
                    <?php 
                        $con=mysqli_connect('localhost','root','','carentalport');
                        $query="select * from `user` where email='".$_SESSION["member_id"]."';";
                        $result=mysqli_query($con,$query);
                        if($result)
                        {   $row=mysqli_fetch_array($result);
                            echo "
                                  <div class='icon1'>
                                    <span class='fa fa-user'></span>
                                    <input class='enable' name='user_name' value='".$row['name']."' style='color:#222;' disabled/>
                                  </div>
                                  <div class='icon1'>
                                    <span class='fa fa-envelope'></span>
                                    <input id='email' name='email' value='".$row['email']."' style='color:#222;' disabled/>
                                  </div>
                                  <div class='icon1'>
                                    <span  class='far fa-calendar-alt'></span>
                                    <input class='enable' name='dob' value='".$row['dob']."' style='color:#222;' disabled/>
                                  </div>
                                  <div class='icon1'>
                                    <span class='fa fa-phone'></span>
                                    <input class='enable' name='phone' value='".$row['phone']."' style='color:#222;' disabled/>
                                  </div>";
                        } 
                    ?>
                    <button class="rotate" id="submit" style="display: none;">SUBMIT</button>        
                </form>	
                <button class="rotate" id="edit" style="display: inline-block;"><span class="fa fa-pencil"></span>EDIT</button>
                <br/><br/>
                <?php
                    if(isset($_REQUEST["msg"]))
                    {
                       if($_GET["msg"]=="editSuccessfull")
                       {
                         echo '<label class="msg_label" style="color:green; font-weight:bold; display: inline-block;">Profile Edited Successfully!</label>';
                       }
                       else if($_GET["msg"]=="editFail")
                       {
                        echo '<label class="msg_label" style="color:red; font-weight:bold; display: inline-block;">Failed to Edit!</label>';
                       }
                    }
                ?>
                </div>
            </div>   
</div>
<script>
     var edit = document.getElementById("edit");
        var submit = document.getElementById("submit");
        var iemail = document.getElementById("email");
        var inputs = document.getElementsByTagName('input');
        edit.onclick = function() {
            for(var i=0;i<inputs.length;i++)
            {
                 inputs[i].disabled= false;
                 inputs[i].style.color= '#6d6c6c';

				 }
            inputs[0].focus();
            iemail.disabled= true;
            edit.style.display= 'none';
            submit.style.display= 'inline-block';
        }
    </script>

</body>
</html>