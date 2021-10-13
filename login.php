<?php

include("include/db.php");
require("include/config.inc.php");


if (count($_POST)>0) {
  te($_POST);
  $sql = "
  SELECT email,passwort FROM users
  WHERE(
    email='". $conn->real_escape_string($_POST['email']). "' AND   passwort='".$conn->real_escape_string($_POST['password'])."'
    )
  ";
$result = $conn->query($sql) or die("Fehler in der query:". $conn->error);

te($sql);
if ($result->num_rows ==1) {
  // output data of each row
$user = $result->fetch_assoc();
   $msg= "
   <p>Sie haben erfolgreich eingelogt</p>

   ";
 }else {
   echo "<p>leider ihre Daten sind nicht korrekt</p>";
  // header("location:registriert.php");
 }

switch ($_POST['wasTun']) {
  case 'outlog':

session_start();
session_destroy();
header('Location: registriert.php');
exit;
    break;

  default:
    // code...
    break;
}

}

 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

     <title></title>
     <style media="screen">
     .center {
      margin: auto;
      width: 50%;
      border: 2px solid gray;
      padding: 10px;
      margin-top: 5rem;
      }
     </style>
<script type="text/javascript">
  function logout(){
document.getElementById("wasTun").value="outlog";
document.getElementById("frm").submit();


  }
</script>
   </head>
   <body>
     <div class="center">
     <form class="" id="frm"  method="post">
       <input type="hidden" name="wasTun" id="wasTun" value="">
       <div class="mb-3">
      <label for="email" class="form-label">Email address:</label>
      <input type="email" class="form-control" id="email" name="email">
    </div>
    <div class="mb-3">
   <label for="password" class="form-label">password:</label>
   <input type="password" class="form-control" id="password" name="password">
 </div>
 <div class="mb-3">
<input type="submit" class="form-control" value="Login"><br>
<button type="button" class="form-control" onclick="logout();" name="button">Logout</button>
</div>
<div class="mb-3">
<p>Not yet a member ?<button  class="form-control" type="button" name="button"><a href="registriert.php">Regestrien</a></button> </p>
</div>

     </form>
      </div>
   </body>
 </html>
