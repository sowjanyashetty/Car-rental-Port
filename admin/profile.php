<!DOCTYPE html >
<?php
session_start();
if(!isset($_SESSION["admin_id"]) && $_SESSION["admin_id"]==false)
{
    header("Location:http://localhost/carrentalport/index.php");
}
else
{
    $con_table=mysqli_connect("localhost","root","","carentalport");
    
}

?>
<html>
    <head>
        <title>CAR RENTAL PORT </title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/admin1.css">
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
     
     <a class="active" href="../admin/admin.php">ADMIN</a>
     <a  href="../users/user.php">USER</a>
     <a  href="../index.php">HOME</a>
   </div>
   <div class="sidenav">
   <a href="../admin/admin.php"  >Dashboard</a>
  <a href="../admin/profile.php" class="active">Profile</a>
  <button class="dropdown-btn">Manage booking
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="bookings.php?msg=user">Users list</a>
    <a href="bookings.php?msg=booking">Booking list</a>
  </div>
  <button class="dropdown-btn">Manage cars
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="manage.php?msg=add">Add cars</a>
    <a href= "manage.php?msg=update">Update cars</a>
    <a href= "manage.php?msg=delete">Delete cars</a>
  </div>
  <a href="../admin/logout.php">Logout</a>
</div>
</header>
<div class="main">
<div id="container" class="content">
                <h1 align="center">My Profile</h1>
                <div class="form">
                <form method="post" action="editprof.php">
                    <?php 
                        $con=mysqli_connect('localhost','root','','carentalport');
                        $query="select * from `admin` where email='".$_SESSION["admin_id"]."';";
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
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });

}
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