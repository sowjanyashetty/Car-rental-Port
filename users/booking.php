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
if(isset($_REQUEST["cancel"]))
{
    $query="delete from booking where email='".$_SESSION["member_id"]."' and v_id=".$_REQUEST["cancel"]." and start_date='".$_REQUEST["sdate"]."';";
    $result_table=mysqli_query($con_table,$query);
    if($result_table)
    {
        $query2="UPDATE `vehicles` SET `available`=1 where v_id=".$_REQUEST["cancel"].";";
        $result=mysqli_query($con_table,$query2);
        if($result)
        {
        ?>
        <script>alert("successfully cancelled");</script>
    <?php    
    }
   }
    else{
        ?>
        <script>alert("Failed to Cancel ! Try again");</script>
    <?php
    }

}
?>
<!DOCTYPE html >
<html>
    <head>
        <title>CAR RENTAL PORT </title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/user2.css">
        <link href="https://fonts.googleapis.com/css?family=Bungee+Inline|Monoton&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Monoton&display=swap" rel="stylesheet">
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
  <a href="../users/profile.php" >Profile</a>
  <a href="../users/booking.php" class="active">My Booking</a>

  <a href="../users/logout.php">Logout</a>
</div>
</header>
<div class="main">
    



<h1 align ="center" style="color:rgb(122, 16, 57)">BOOKING LIST</h1>
</div>
<div id="car_booklist"  class="booklist_display">
    <table class="booklist" id="brand">
        <tr>
        <th>Vehicle id</th>
        <th>brand</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Location</th>
        <th>Cancel</th>
       </tr>
    <?php
    $query="select * from vehicles v,booking b where v.v_id=b.v_id and b.email='".$_SESSION["member_id"]."' and b.status=1 ;";
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
        <td><?php echo $row['start_date'];$_SESSION['sdate']=$row['start_date'];
        ?></td>
        <td><?php echo $row['end_date']
        ?></td>
        <td><?php echo $row['location']
        ?></td>
        <?php
          $date1=date('Y/m/d');
          $date2=$row['end_date'];
          $date3=$row['start_date'];

          if(strtotime($date2) > strtotime ($date1) && strtotime($date3) > strtotime($date1))
          {
              ?>
               <td><?php echo '<a style="color:green;" href="http://localhost/carrentalport/users/booking.php?cancel='.$row['v_id'].'&sdate='.$date3.'">Cancel</a>';?></td>
              <?php
          }
          else
          {
            ?>
            <td><?php echo '<a style="color:gray;" href="#">Cancel</a>';?></td>
            <?php
        }
        ?>
        
       
        
    </tr>
        
    <?php
    
    }
   }
   
    

    ?>

</table>
</div>
</div>
</body>
</html>