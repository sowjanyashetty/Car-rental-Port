<?php
session_start();
 $con=mysqli_connect('localhost','root','','carentalport');
 
 $user_name=$_POST['user_name'];
 $phone=$_POST['phone'];
 $dob=$_POST['dob'];
 $email=$_SESSION["admin_id"];
 ?>
 <script>alert($email)</script>
 <?php
 $update_query="update admin set  name='$user_name', phone= $phone,dob= '$dob' where email='$email';";
 $update_result=mysqli_query($con,$update_query);      
 if(mysqli_affected_rows($con)!=0)  
 {        
     header("Location:http://localhost/carrentalport/admin/profile.php?msg=editSuccessfull");
 }
 else
 {
    header("Location:http://localhost/carrentalport/admin/profile.php?msg=editFail");
 }
?> 