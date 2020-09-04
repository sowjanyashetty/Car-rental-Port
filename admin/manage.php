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
        <link rel="stylesheet" href="../css/admin2.css">
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
     if(isset($_POST["delete"]))
     {
      $con1 = mysqli_connect("localhost","root","","carentalport");
      $v=$_POST['v1'];
      $query3="update  vehicles set removed=0 where v_id=$v";
      $result3 = mysqli_query($con1,$query3);
      if($result3)
      {
        ?><script>alert("Deleted Scuccessfully");</script>
        <?php
      }
      else
      {
        ?><script>alert("Failed to Delete");</script>
        <?php
      }


     }
    if(isset($_POST["edit"]))
    {
      $con = mysqli_connect("localhost","root","","carentalport");
      $v=$_POST['v'];
      $capacity=$_POST['c'];
      $brand=$_POST['b'];
      $image=$_POST['i'];
      $a=$_POST['a'];
      $c=$_POST['co'];
      $query2="UPDATE `vehicles` SET `brand_name`='$brand',`cost_perday`=$c,`capacity`=$capacity,`image`='$image',`available`=$a WHERE v_id=$v";
      $result2=mysqli_query($con,$query2);
      if($result2)
      {
        ?><script>alert("updated Scuccessfully");</script>
        <?php
      }
      else
      {
        ?><script>alert(" unsuccessful");</script>
        <?php
        
      }
    }
   if(isset($_POST["save"]))
   {
    $con = mysqli_connect("localhost","root","","carentalport");
    if(mysqli_connect_errno($con))
    {
        ?>

      <script>alert('connection failed');</script>

     <?php
    }
    else{
      $v=$_POST['v_id'];
      $capacity=$_POST['capacity'];
      $brand=$_POST['brand'];
      $image=$_POST['image'];
      $a=$_POST['available'];
      $c=$_POST['cost'];
      $query1="INSERT INTO `vehicles`(`v_id`, `brand_name`, `cost_perday`, `capacity`, `image`, `available`) VALUES ($v,'$brand',$c,$capacity,'$image','$a');";
      $result_table=mysqli_query($con_table,$query1);
      if($result_table)
      {?>

        <script>alert('Successfully Inserted to Database');
        </script>
        

       <?php

      }
      else
      {?>

        <script>alert('Failed to Insert');</script>
        

       <?php

      }

 

   }
      }
      //delete
      if(isset($_POST['search']))
      {
         $v=$_POST['searchisbn'];
     
         $con = mysqli_connect("localhost", "root", "", "carentalport");

         // Check connection
         if($con === false)
          {
            die("ERROR: Could not connect. " . mysqli_connect_error());
          }

          // Attempt select query execution
         $sql = "SELECT * FROM  vehicles where v_id = $v";
         if($result = mysqli_query($con, $sql))
           {
             if(mysqli_num_rows($result) > 0)
             {
               $row=mysqli_fetch_assoc($result)
   ?>
                <div class="main">
    <h1 align="center" style="color:rgb(122, 16, 57);">DELETE CARS</h1>
</div>
                <div class="addformbook"  id="addformbook"style="display:block">
                <form  name="book" method="POST" action="manage.php?msg=add" onsubmit="return check()">
                   <label>Vehicle Id</label><input  name="v"type="number"  value="<?php echo $row["v_id"];?>" disabled/>
                   <input style="display:none;" name="v1"type="number"  value="<?php echo $row["v_id"];?>" />
                   <label>Capacity</label><input name="c"type="text"  value="<?php echo $row["capacity"];?>" disabled/><br>
                   <label>Brand </label><input name="b"type="text"  value="<?php echo $row["brand_name"];?>" disabled/>
                   <label>Cost Per Day</label><input name="co"type="number"  value="<?php echo $row["cost_perday"];?>"disabled/><br>
                   <label>Image Path</label><input name="i"type="text" value="<?php echo $row["image"];?>" disabled/>
                   <label>Available</label><input name="a"type="number"value="<?php echo $row["available"];?>"disabled/><br>
                   
                   
                   
                    <div class="addbookbutton" style="display:block">
                         <button style="background-color:rgb(122, 16, 57);margin-left:160px;" onclick="return confirmation();"type="submit" name="delete">DELETE</button>
                         
                    </div>
                    
              </form>
            
      </div>
      <?php
       }
       else
       {
        header("Location:http://localhost/carrentalport/admin/manage.php?msg=delete");
       }
       }
       
       
	  }
      //update
      if(isset($_POST['submit']))
      {
         $v=$_POST['searchisbn'];
     
         $con = mysqli_connect("localhost", "root", "", "carentalport");

         // Check connection
         if($con === false)
          {
            die("ERROR: Could not connect. " . mysqli_connect_error());
          }

          // Attempt select query execution
         $sql = "SELECT * FROM  vehicles where v_id = $v";
         if($result = mysqli_query($con, $sql))
           {
             if(mysqli_num_rows($result) > 0)
             {
               $row=mysqli_fetch_assoc($result)
   ?>
                <div class="main">
    <h1 align="center" style="color:rgb(122, 16, 57);">UPDATE CARS</h1>
</div>
                <div class="addformbook"  id="addformbook"style="display:block">
                <form  name="book" method="POST" action="manage.php?msg=add" onsubmit="return check()">
                   <label>Vehicle Id</label><input  name="v"type="number"  value="<?php echo $row["v_id"];?>" disabled/>
                   <input style="display:none;" name="v"type="number"  value="<?php echo $row["v_id"];?>" />
                   <label>Capacity</label><input name="c"type="text"  value="<?php echo $row["capacity"];?>" required/><br>
                   <label>Brand </label><input name="b"type="text"  value="<?php echo $row["brand_name"];?>" required/>
                   <label>Cost Per Day</label><input name="co"type="number"  value="<?php echo $row["cost_perday"];?>"required/><br>
                   <label>Image Path</label><input name="i"type="text" value="<?php echo $row["image"];?>" required/>
                   <label>Available</label><input name="a"type="number"value="<?php echo $row["available"];?>"required/><br>
                   
                   
                   
                    <div class="addbookbutton" style="display:block">
                         <button style="background-color:rgb(122, 16, 57);margin-left:70px;" type="submit" name="edit">UPDATE</button>
                         <button  style="background-color:rgb(122, 16, 57);"type="reset">RESET</button>
                    </div>
                    
              </form>
            
      </div>
      <?php
       }
       else
       {
        header("Location:http://localhost/carrentalport/admin/manage.php?msg=update");
       }
       }
       
       
	  }


 
 if(isset($_REQUEST["msg"]))
 {
   if($_REQUEST["msg"]=='add')
   {
 


       ?>
       <div class="main">
    <h1 align="center" style="color:rgb(122, 16, 57);">ADD CARS</h1>
</div>
      <div id="container" class="content"  >
    <div class="addformbook"  id="addformbook"style="display:block">
                <form  name="book" method="POST" action="manage.php?msg=add" onsubmit="return check()">
                   <label>Vehicle Id</label><input  name="v_id"type="number" placeholder="Vehicle Id" required/>
                   <label>Capacity</label><input name="capacity"type="text" placeholder="Capacity" required/><br>
                   <label>Brand </label><input name="brand"type="text" placeholder="Brand Name" required/>
                   <label>Cost Per Day</label><input name="cost"type="number" placeholder="Cost Per Day"/><br>
                   <label>Image Path</label><input name="image"type="text"placeholder="Image" required/>
                   <label>Available</label><input name="available"type="number"placeholder="status"/><br>
                   
                   
                   
                    <div class="addbookbutton" style="display:block">
                         <button style="background-color:rgb(122, 16, 57);" type="submit" name="save">SUBMIT</button>
                         <button  style="background-color:rgb(122, 16, 57);"type="reset">RESET</button>
                    </div>
                    
              </form>
            
      </div>
              
              
          
                
   </div> 
   
    <?php
    }
 
   else if($_REQUEST["msg"]==='update')
   {?>
    <div class="esearch"  id="info"style="display:block ;margin-left:45%;margin-top:5%;">
    <form name="editbook" method="POST" action="manage.php">
        <input type="number" name="searchisbn" placeholder="Enter Vehicle Id" />
        <button type="submit" name="submit" :focus style="outline:none"> <i class='fas fa-search'></i></button>
    </form>
   </div>

  <?php }
   else
   {
    ?>
    <div class="esearch"  id="info"style="display:block ;margin-left:45%;margin-top:5%;">
    <form name="editbook" method="POST" action="manage.php">
        <input type="number" name="searchisbn" placeholder="Enter Vehicle Id" />
        <button type="submit" name="search" :focus style="outline:none"> <i class='fas fa-search'></i></button>
    </form>
   </div>

  <?php
   }
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
function confirmation()
{
 if(confirm("Do You Want to Delete"))
 {
   return true;
 }
 return false;
  
}
</script>
</body>
</html>