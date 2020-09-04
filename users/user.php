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
if (isset($_POST["confirm_booking"]))
{
    $s=$_POST["start_date"];
    $e=$_POST["end_date"];
    $l=$_POST["location"];
    $em=$_SESSION["member_id"];
    $v=$_SESSION["id"];
    $sql= "insert into booking (v_id,email,start_date,end_date,location,status) values($v,'$em','$s','$e','$l',0);";
    if(mysqli_query($con_table,$sql))
    {
        ?>
        <script>alert("Succefully placed order wait for confirmation ");</script>
    <?php
    }
    else
    {
        ?>
        <script>alert("Failed ");</script>
    <?php
       
    }

}


?>
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
   <a href="../users/user.php" class="active" >Dashboard</a>
  <a href="../users/profile.php">Profile</a>
  <a href="../users/booking.php">My Booking</a>
  <a href="../users/logout.php">Logout</a>
</div>
</header>
<div class="main">
    <h1 id="brandlist_heading"align ="center" style="color:rgb(122, 16, 57)">Available Category</h1>
</div>
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
        <?php $query2="select count(*)  as count from vehicles where brand_name='".$row['brand_name']."'and available > 0 and removed=1;";
    $result=mysqli_query($con_table,$query2);
    $count=mysqli_fetch_array($result)?>
        <td><?php echo $count['count'] ?></td>
        
        <td><?php echo '<a href="http://localhost/carrentalport/users/user.php?msg='.$row['brand_name'].'">View</a>';?></td>
        
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
    document.getElementById("brandlist_heading").style.display="none";
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
  <th>Book</th>
  </tr>
  <?php
   $query="select * from vehicles where brand_name='".$_REQUEST["msg"]."'and available >0 and removed=1;";
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
       
       <td><?php echo '<a  style="color:green" href="http://localhost/carrentalport/users/user.php?book='.$row['v_id'].'">BOOK NOW!!</a>';?></td>
       
   </tr>
   
       
   <?php
   
   }
  }
}?>
 </table>
  </div>
  <!-- booking window -->
  <?php
  if(isset($_REQUEST["book"]))
{
    ?>

    <script>
        document.getElementById("car_brandlist").style.display="none";
    document.getElementById("brandlist_heading").style.display="none";
       document.getElementById("brand").style.display="none";
    document.getElementById("carlist_disp").style.display="none";
    document.getElementById("carlist_heading").style.display="none";
       document.getElementById("carlist").style.display="none";
       document.getElementById("book_disp").style.display="block";

    </script>
   <h1 id="carlist_heading " align="center" style="color:rgb(122, 16, 57);margin-top:3%;margin-left:10%;"> BOOK </h1>
<div class="book_car_disp" id="book_disp" >
<?php
    $query2="select * from vehicles where v_id=".$_REQUEST["book"]." and available >0;";
    $_SESSION["id"]=$_REQUEST["book"];
    $result2=mysqli_query($con_table,$query2);
   if($result2)
   {
   while($row2 = mysqli_fetch_array($result2))
   {
   ?>
    <div class="image_disp">
    <div class="book_image">
      <img style="opacity:0.9" width=100% height=100% src ="../img/<?php echo $row2["image"] ?>"/>
    </div>
   <div class="book_details">
       <br>
   <b style="color:white; padding:20px;">Capacity:<?php echo $row2["capacity"] ?></b>
   <br>
   <br>
   <b style="color:white;padding:20px;">Cost Per Day:<?php echo $row2["cost_perday"];$_SESSION["cost"]=$row2["cost_perday"];?></b>
   </div>
   </div>
   <div class="details_disp">
   <form class="container" id="book_form" method="POST" action="user.php">
   <b style="color:black; padding:20px;">Start Date</b>
   <input type="date" id="sdate" name="start_date" placeholder="Enter Start Date"/>
   <br><b style="color:black; padding:20px;">End Date</b>&nbsp&nbsp
   <input type="date" id="edate" name="end_date" placeholder="Enter End Date"/>
   <br><b style="color:black; padding:20px;">Location</b>&nbsp&nbsp&nbsp
   <input type="text" name="location" placeholder="Enter Location" required/>
   <button class="btn1" name="total" onclick="return sum();">Total amount</button>
   <button class="btn" name="confirm_booking">Confirm Booking!!</button>
   </form>
   </div>
   <?php
   }
}
?>



   <?php
   
}?>
 <div>


 



<script>
    function sum()
    {
        const sdate= new Date(document.getElementById("sdate").value);
        const edate= new Date(document.getElementById("edate").value);
        const diffTime = Math.abs(edate-sdate);
        const diffDays =Math.ceil(diffTime/(1000*60*60*24))+1;
        const cost="<?php echo $_SESSION["cost"]?>";
        const v= diffDays*cost

        
        alert("Total cost will be = "+v);
        
        return false;
    }
    function aleternateColor(id)
    {
        var i=0;
        var tables=document.getElementById(id);
        var rows = tables.getElementByTagName("tr");
        for (i=0;i<rows.length;i++)
        {
            if(i%2==0)
            {
                rows[i].className ="even";
            }
            else{
                rows[i].className="odd";
            }
        }
    }
    function openlist(n)
    {
        alert(n);
    }
    function closebarndlist()
    {
       document.getElementById("car_brandlist").style.display="none";
       document.getElementById("brand").style.display="none";
       document.getElementById("carlist").style.display="block";
    }
</script>

</body>
</html>