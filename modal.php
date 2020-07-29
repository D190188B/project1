<?php
if(isset($_POST['submit'])){
  // error variable.
  $error = array();
  
  $birth=$_POST['birth'];
  
  $name = validate_input_text($_POST['name']);
  if (empty($name)){
      $error[] = "You forgot to enter your Name";
  }
  
  $email = validate_input_email($_POST['email']);
  if (empty($email)){
      $error[] = "You forgot to enter your Email";
  }
  
  $password = validate_input_text($_POST['password']);
  if (empty($password)){
      $error[] = "You forgot to enter your password";
  }
  
  $confirm_pwd = validate_input_text($_POST['confirm_pwd']);
  if (empty($confirm_pwd)){
      $error[] = "You forgot to enter your Confirm Password";
  }

  
  $files = $_FILES['profileUpload'];
  $profileImage = upload_profile('./images/profile/', $files);
  

  if(empty($error) && ($password == $confirm_pwd)){
    
    
      $generateid = uniqid();
      // register a new user
      $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
  
      $sqli = "Select * from client where email='$email'";//username and password same ？
      $result1= mysqli_query($conn,$sqli);//sql
  
      $count = mysqli_num_rows($result1);
  
      if($count == 0){
      $sql="insert into client values('$generateid','$name','$birth','$email','$hashed_pass','$profileImage',NOW())";
      $result=$conn->query($sql);
  
      echo '<script>window.alert("Registration successful...!")</script>';
  
      }else{
          echo '<script>window.alert("This email has already registered...!")</script>';
      }
      }else{
      echo '<script>window.alert("Password is not match....!!!!")</script>';
      }
  }
?>
<head>
<script>
$(document).ready(function (e) {

let $uploadfile = $('#register .modal .modal-dialog .modal-content .modal-body input[type="file"]');

$uploadfile.change(function () {
    readURL(this);
});


// $("#reg-form").submit(function (event) {
//         let $password = $("#password");
//         let $confirm = $("#confirm_pwd");
//         let $error = $("#confirm_error");
//         if($password.val() == $confirm.val()){
//             return true;
//         }else{
//             $error.text("Password not Match");
//             event.preventDefault();
//         }
//     });
});

function readURL(input) {
if(input.files && input.files[0]){
    let reader = new FileReader();
    reader.onload = function (e) {
        $("#register .modal .modal-dialog .modal-content .modal-body .img").attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
}
}

</script>

<style>
#register img{
    margin-left:283px
}
@media screen and (max-width:767px){
#register img{
    margin-left:100px
}
}
</style>
</head>
<section id="register">
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLongTitle">Register Form</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <img src="images/profile/beard.png" style="width: 200px; height: 200px;margin-bottom:10px;" class="img rounded-circle" alt="profile" id="image">
      <small class="form-text text-black-50" style="text-align:center;padding-right:10px;">Choose Image</small>
      <input type="file" class="form-control-file" name="profileUpload" id="upload-profile" form="reg-form">

      <form id="reg-form" method="post" enctype="multipart/form-data">
        <div class="col">
            <h4>Username</h4>
            <input type="text" required name="name" id="name" class="form-control" placeholder="username" >
        </div>

        <div class="col">
            <h4>Birthday</h4>
              <input type="date" required name="birth" id="birth" class="form-control" >
        </div>

        <div class="col">
            <h4>Email</h4>
              <input type="email"  required name="email" id="email" class="form-control"  placeholder="email">
        </div>

        <div class="col">
            <h4>Password</h4>
              <input type="password" required name="password" id="password" class="form-control"  placeholder="password">
        </div>

        <div class="col">
            <h4>Confirm Password</h4>
              <input type="password" required name="confirm_pwd" id="confirm_pwd" class="form-control" placeholder="confirm password" >
              <small id="confirm_error" class="text-danger"></small>
        </div>

        <div class="col" style="margin-top:20px;">
            <input type="checkbox" style="margin-left:10px;margin-top:7px;" name="agreement" style="padding-left:30px;" class="form-check-input" required>
            <label for="agreement" style="padding-left:20px;padding-bottom:5px;;" class="form-check-label font-ubuntu text-black-50">I agree <a href="#">term, conditions, and policy </a>(*) </label>
        </div>
       
  
      <div class="modal-footer">
        <input type="submit" class="form-control" name="submit" value="Register" id="submit">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      
      </form>
    </div>
  </div>
</div>

<section>