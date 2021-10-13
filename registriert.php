<?php
  session_start();
include("include/db.php");
require("include/config.inc.php");
$msg="";
if (count($_POST)>0) {
  te($_POST);
  $username=$conn->real_escape_string($_POST['username']);
  $email=$conn->real_escape_string($_POST['Email']);
  $pw1=$conn->real_escape_string($_POST['Passwort1']);
  $pw2=$conn->real_escape_string($_POST['Passwort2']);
  if ($pw1==$pw2) {
    $pw=md5($pw1);//hash passwort
    $sql = "
    INSERT INTO users (username,email,passwort)
VALUES
(
  '". $username ."',
  '". $email ."',
   '". $pw ."'
   )";

if ($conn->query($sql) === TRUE) {
  $msg= "<p>Sie haben erfolgreich registriert.</p>";
} else {
  $msg= "Error: " . $sql . "<br>" . $conn->error;
}
  }
}


 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

     <title>Regestrien Formular</title>
     <style media="screen">
     .center {
      margin: auto;
      width: 50%;
      border: 2px solid gray;
      padding: 10px;
      margin-top: 5rem;
      }
     </style>
   </head>
   <body>
     <?php echo $msg; ?>
     <div class="center">
     <form  method="post">
     <div class="mb-3 row">
         <label for="username" class="col-sm-2 col-form-label">Username:</label>
         <div class="col-sm-10">
           <input type="text" class="form-control" id="username" name="username">
         </div>
       </div>
       <div class="mb-3 row">
         <label for="Email" class="col-sm-2 col-form-label">Email:</label>
         <div class="col-sm-10">
           <input type="email" class="form-control" id="Email" name="Email">
         </div>
       </div>
       <div class="mb-3 row">
           <label for="Passwort1" class="col-sm-2 col-form-label">Passwort:</label>
           <div class="col-sm-10">
             <input type="password"  class="form-control" id="Passwort1" name="Passwort1">
           </div>
         </div>
         <div class="mb-3 row">
           <label for="Passwort2" class="col-sm-2 col-form-label">Confirm:</label>
           <div class="col-sm-10">
             <input type="password" class="form-control" id="Passwort2" name="Passwort2">
           </div>
         </div>
         <div class="mb-3 row">
           <div  class="col-sm-12">
             <input type="submit" class="form-control"  value="Regestrien">
           </div>
         </div>

         <div class="mb-3 row">
           <div  class="col-sm-12">
             <p>Alreadsy a member <button class="form-control" type="button" name="button"><a  href="login.php">Login</a></button></p>
           </div>
         </div>


        </form>
             </div>
   </body>
 </html>
