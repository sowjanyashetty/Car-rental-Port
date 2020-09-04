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
   <a href="../admin/admin.php" class="active" >Dashboard</a>
  <a href="../admin/profile.php">Profile</a>
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
<div class="main">
    <h1 id="dashboard" align="center" style="color: rgb(122, 16, 57);"> DASHBOARD</h1>
</div>

</header>
<div id="car_brandlist"  class="brandlist_display">
    <table class="brandlist" id="brand">
        <tr>
        <th>Brands</th>
        <th>No Of Cars</th>
        <th>Select</th>
       </tr>
    <?php
    $query="select distinct brand_name from vehicles";
    $result_table=mysqli_query($con_table,$query);
    if($result_table)
    {
    while($row = mysqli_fetch_array($result_table))
    {
    ?>
    <tr>
        <td><?php echo $row['brand_name']
        ?></td>
        <?php $query2="select count(*)  as count from vehicles where brand_name='".$row['brand_name']."'and removed= 1;";
    $result=mysqli_query($con_table,$query2);
    $count=mysqli_fetch_array($result)?>
        <td><?php echo $count['count'] ?></td>
        
        <td><?php echo '<a href="http://localhost/carrentalport/admin/admin.php?msg='.$row['brand_name'].'">View</a>';?></td>
        
    </tr>
        
    <?php
    
    }
   }
   
    

    ?>

</table>
</div>
<?php
if(isset($_REQUEST["msg"]))
{
    ?>

    <script>document.getElementById("car_brandlist").style.display="none";
    document.getElementById("dashboard").style.display="none";
       document.getElementById("brand").style.display="none";
       document.getElementById("carlist").style.display="block";</script>
   <h1 id="carlist_heading " align="center" style="color:rgb(122, 16, 57);margin-top:3%;margin-left:10%;"> CAR LIST </h1>
<div class="carlist_display" id="carlist_disp" >
  <table id="carlist" onload="">
  <tr>
  <th>Image</th>
  <th>vehicle Id</th>
  <th>Capacity</th>
  <th>Cost Per Day</th>
  <th>Available</th>
  </tr>
  <?php
   $query="select * from vehicles where brand_name='".$_REQUEST["msg"]."' and removed=1;";
   $result_table=mysqli_query($con_table,$query);
   if($result_table)
   {
   while($row = mysqli_fetch_array($result_table))
   {
   ?>
   <tr>
       <td><div style="width:200px;height:200px;display:flex" class="book_image"><img width=100% height=100% src="../img/<?php echo $row['image']
       ?>"/></div></td>
       <td><?php echo $row['v_id']
       ?></td>
       <td><?php echo $row['capacity']
       ?></td>
       <td><?php echo $row['cost_perday']
       ?></td>
       <?php
         if($row["available"])
         {?>
         <td><?php echo "YES"
       ?></td>
       <?php

         }
         else
         {
            ?>
         <td><?php echo "NO"
       ?></td>
       <?php 
         }
       ?>
       
       
       
   </tr>
   
       
   <?php
   
   }
  }
}?>
 </table>
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
</script>
</body>
</html>