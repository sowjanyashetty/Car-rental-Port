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
                        
                        
                
}?>
<html>
    <head>
        <title>CAR RENTAL PORT </title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/admin1.css">
        <link href="https://fonts.googleapis.com/css?family=Bungee+Inline|Monoton&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Monoton&display=swap" rel="stylesheet">
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
  <a href="../admin/profile.php" >Profile</a>
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
<?php
   if(isset($_REQUEST["confirm"]))
   {
    
        
    $v=$_REQUEST["confirm"];
    $email=$_REQUEST["email"];
    $sdate=$_REQUEST["sdate"];
    $query1="update booking set status=1 where v_id=$v and email='$email' and start_date='$sdate'";
    $result=mysqli_query($con_table,$query1);
    $query2="update vehicles set available=0 where v_id=$v";
    $result2=mysqli_query($con_table,$query2);
    if($result && $result2)
    {
        ?>
        <script>alert("confirmed");</script>
        <?php
         header("Location:http://localhost/carrentalport/admin/bookings.php?msg=booking");

    }
    
     
   }
   else if(isset($_REQUEST["msg"]))
   {
       if($_REQUEST["msg"]==='user')
       {?>
            <div class="main">
             <h1 align="center" style="color: rgb(122, 16, 57);">USERS LIST</h1>
         </div>
            <div id="userlist"  class="brandlist_display">
                <table class="brandlist" id="brand">
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                  </tr>
            <?php
               $query="select* from user";
               $result_table=mysqli_query($con_table,$query);
               if($result_table)
                {
                    while($row = mysqli_fetch_array($result_table))
                     {
                      ?>
                        <tr>
                           <td><?php echo $row['name']
                            ?></td>
               
                           <td><?php echo $row['email'] ?></td>
                           <td><?php echo $row['phone'] ?></td>
                        </tr>
        
                    <?php
    
                       }
                }
          ?>

                </table> 
             </div>
   <?php
       }
       else
       {
        ?>
        <div class="main">
             <h1 align="center" style="color: rgb(122, 16, 57);">BOOKING LIST</h1>
         </div>
        <div id="bookinglist"  class="brandlist_display">
            <table class="brandlist" id="book_list">
              <tr>
                <th>Vehivle Id</th>
                <th>Brand</th>
                <th>Email</th>
                <th>StartDate</th>
                <th>EndDate</th>
                <th>Confirm</th>
              </tr>
        <?php
           $query="select* from vehicles v,booking b where v.v_id=b.v_id";
           $result_table=mysqli_query($con_table,$query);
           if($result_table)
            {
                while($row = mysqli_fetch_array($result_table))
                 {
                  ?>
                    <tr>
                       <td><?php echo $row['v_id']
                        ?></td>
                        <td><?php echo $row['brand_name']
                        ?></td>
           
                       <td><?php echo $row['email'] ?></td>
                       <td><?php echo $row['start_date'] ?></td>
                       <td><?php echo $row['end_date'] ?></td>
                    
    
                <?php
                  if($row['status'])
                  {
                      ?><td><?php echo '<a style="color:gray;text-decoration:none;"href="#">Confirmed</a>';?></td>
      
            <?php     }
            else
            {
              ?><td><?php echo '<a style="color:green;" href="http://localhost/carrentalport/admin/bookings.php?confirm='.$row['v_id'].'&email='.$row["email"].'&sdate='.$row["start_date"].'">Confirm</a>';?></td>
      
              <?php  
      
                     
                  
            }?>
            </tr>
         <?php   
      }
      ?>

            </table> 
         </div>
<?php

       }

   }
}
   else
     {
        header("Location:http://localhost/carrentalport/admin/admin.php");
     }
   ?>
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
</script>
</body>
</html>