<!DOCTYPE html >

<?php
     session_start();
   
   		if(isset($_POST['login'])){
			$con=mysqli_connect("localhost","root","","carentalport");
			$email=$_POST["email"];
			$pass=$_POST["password"];
			$sql="select * from user";
			$result=mysqli_query($con,$sql);
			if($result){
				$flag=0;
				while($row=mysqli_fetch_array($result)){
					if($row['email']==$email){
						if($row['password']==$pass){
							
                  setcookie ("email",$email);
					        $_SESSION["member_id"] = $email;
					       
					        header("Location: users/user.php");
                }
                $flag=1;
                if($row['password']!=$pass)
                 {
                   ?><script>alert("Incorrect Password");</script><?php
                 }
				        
			        }
		        }
		        if($flag==0){
                 ?><script>alert("Not yet registered");</script><?php
            }
            }
    }
    if(isset($_POST['adminlogin'])){
			$con=mysqli_connect("localhost","root","","carentalport");
			$email=$_POST["email"];
			$pass=$_POST["password"];
			$sql="select * from admin";
      $result=mysqli_query($con,$sql);
      
			if($result){
				$flag=0;
				while($row=mysqli_fetch_array($result)){
					if($row['email']==$email){
						if($row['password']==$pass){
							
					        setcookie ("email",$email);
					        $_SESSION["admin_id"] = $email;
					       
					        header("Location: admin/admin.php");
				        }
				        if($row['password']!=$pass)
				         	?><script>alert("Incorrect Passwaod");</script><?php
				        $flag=1;
			        }
		        }
		        
            }
    }
    if(isset($_POST['register']))
    {        
      $user_name=$_POST["username"];
      $email=$_POST["email"];
      $phone=$_POST["phone"];
      $password=$_POST["psw"];
      $cpassword=$_POST["cpsw"];
      $dob=$_POST["dob"];
      setcookie("email",$email);
    if($user_name!=null && $email!=null && $phone!=null && $password!=null && $cpassword!=null)
      {
        

        if(preg_match("/gmail/",$email))
        {
          if($password==$cpassword)
          {
              $servername="localhost";
              $dbuser="root";
              $dbpass="";
              $database="carentalport";
              $con=mysqli_connect($servername,$dbuser,$dbpass,$database);
              if(!$con)
              {
                die("Connection failed".mysqli_connect_error());
              }
              $sql="insert into `user`(name,email,phone,password,dob) values ('$user_name','$email',$phone,'$password','$dob')";
              $result=mysqli_query($con,$sql);
              if(mysqli_affected_rows($con)!=0)
              {
                setcookie ("user_id",$email);
                $_SESSION["member_id"] = $email;
                header("Location: users/user.php");
              }
              else
              {
                ?><script>alert("Unsuccessfull");</script>
              <?php
              }
          }
          ?>
          <script>alert("Password missmatch");</script>
          <?php
        }
      }
      
      }
     
    
		?>
<html>
    <head>
        <title>CAR RENTAL PORT </title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/mains.css">
        <link href="https://fonts.googleapis.com/css?family=Bungee+Inline|Monoton&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Monoton&display=swap" rel="stylesheet">
    </head>
    <body>
    <header>
    <div class="topnav">
    <a href="#about">ABOUT</a>
     
     <a href="#" onclick="javascript:openadminForm()">ADMIN</a>
     <a  href="#" onclick="javascript:openForm()">USER</a>
     <a class="active" href="#home">HOME</a>
   </div>

</header>
<div class="slideshow-container">

<!-- Full-width images with number and caption text -->
<div class="mySlides fade">
  <div class="numbertext">1 / 3</div>
  <img alt ="img1" src="img/img10.jpg" style="width:100%;" >
  <div class="text">FIND YOUR DREAM CARS FOR RENT !! </div>
  
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 3</div>
  <img src="img/img8.jpg" style="width:100%;" >
  <div class="text">FIND YOUR DREAM CARS FOR RENT !! </div>
  
  
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 3</div>
  <img src="img/img9.jpg" style="width:100% ;">
  <div class="text">FIND YOUR DREAM CARS FOR RENT !! </div>

</div>

<!-- Next and previous buttons -->
<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>


<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
 
  slides[slideIndex-1].style.display = "block";  
 
}
</script>


<div class="form-popup" id="myForm">

  <form action="index.php" class="form-container" method="POST">
  <button type="button" style="background-color:#ccb7ae" class="close" aria-label="Close"onclick="closeForm()">
  <span aria-hidden="true">&times;</span>
   </button>
    <h1 align="center">Login</h1>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <button type="submit" name="login" class="btn">Login</button>
    
    <button type="button"  class="sign" onclick="signupForm()">Sign Up</button>
  </form>
</div>
<div class="form-popup" id="adminForm">

  <form action="index.php" class="form-container" method="POST">
  <button type="button" style="background-color:#ccb7ae" class="close" aria-label="Close"onclick="closeForm()">
  <span aria-hidden="true">&times;</span>
   </button>
    <h1 align="center">Login</h1>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <button type="submit" name="adminlogin" class="btn">Login</button>
    
    
  </form>
</div>

<div class="form-popup" id="signForm" >

  <form action="index.php" class="form-container1" method="POST">
  <button type="button" style="background-color:#ccb7ae" class="close" aria-label="Close"onclick="closeForm()">
  <span aria-hidden="true">&times;</span>
   </button>
    <h1 align="center">Register</h1>
    <label for="name"><b>Name</b></label>
    <input type="text" placeholder="Enter Name" name="username" required>
    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
    <label for="cpsw"><b>Confirm Password</b></label>
    <input type="password" placeholder="Enter Password" name="cpsw" required>
    <label for="dob"><b>DOB</b></label>
    <input type="date" placeholder="Enter Date Of Birth" name="dob" required>
    <label for="address"><b>Phone</b></label>
    <input type="number" placeholder="Enter Phone Number" name="phone" required>

    <button type="submit" name="register" class="btn">Register!!</button>
    
    
  </form>
</div>
<script>
function openForm() {
  
  document.getElementById("signForm").style.display = "none";
  document.getElementById("adminForm").style.display = "none";

  document.getElementById("myForm").style.display = "block";
}
function openadminForm() {
  
  document.getElementById("myForm").style.display = "none";
  document.getElementById("signForm").style.display = "none";
  document.getElementById("adminForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
  document.getElementById("signForm").style.display = "none";
  document.getElementById("adminForm").style.display = "none";
}
function signupForm() {
  document.getElementById("myForm").style.display = "none";
  document.getElementById("adminForm").style.display = "none";
  document.getElementById("signForm").style.display = "block";
}
</script>

    </body>
</html>