<?php
session_start();
if(isset($_SESSION['username'])){
  echo ("<script>window.location='index.php';</script>");
}
include("connection.php");
if(isset($_POST['login'])){
   $username = $_POST['username'];
   $password = $_POST['password'];
  $login_check = $sql->prepare("SELECT * FROM `user` WHERE `username` = ?");
  $login_check->bind_param('s',$username);
  $login_check->execute();
  $login_ckeck_result = $login_check->get_result();
  if($login_ckeck_result->num_rows>0){
    $login_data = $login_ckeck_result->fetch_assoc();
    $userpassword = $login_data['password'];
    if($userpassword == $password){
      $_SESSION['username'] = $login_data['username'];
      echo ("<script> alert('login succesfully')</script>");
      echo ("<script>window.location='index.php';</script>");
    }else{
      echo("<script>alert('login failed')</script>");
    }
  }
  else{
    echo("<script>alert('login details not found please check details or sing up')</script>");
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="login.css" />
    <title>Login</title>
    <style></style>
  </head>
  <body>
    <form class="modal-content animate" action="" method="post">
      <div class="parent_div" style="background-color: rgb(124, 172, 228)">
        <div class="imgcontainer">
          <!-- <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span> -->
          <img src="Avatar.png" alt="Avatar" class="avatar" />
        </div>

        <div class="container">
          <label for="uname"><b>Username</b></label>
          <input
            type="text"
            placeholder="Enter Username"
            name="username"
            required
          />

          <label for="psw"><b>Password</b></label>
          <input
            type="password"
            placeholder="Enter Password"
            name="password"
            required
          />

          <button type="login" name="login">Login</button>
        </div>

        <div class="container">
          <!-- <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button> -->
          <span class="psw">REGISTER <a href="signin.php">Sign Up</a></span>
        </div>
      </div>
    </form>

    <script>
      // Get the modal
      // var modal = document.getElementById('id01');

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function (event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      };
    </script>
  </body>
</html>
