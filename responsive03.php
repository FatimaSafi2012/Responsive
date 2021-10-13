<?php
include("includes/db.php");
require("includes/config.inc.php");

if (count($_POST)>0) {
  te($_POST);
  // $email=$_POST['inputEmail4'];
  // $password=$_POST['inputPassword4'];

  $sql = "
  SELECT * FROM tbl_test2_user
  WHERE(
  Emailadresse='".$conn->real_escape_string($_POST['inputEmail4'])."' AND
  PWD = '".   $conn->real_escape_string($_POST['inputPassword4']) ."'
    )

  ";
$iduser=0;
  $result = $conn->query($sql)or die("Fehler in der Query:" . $conn->error);
  //te($result);
  if ($result->num_rows ==1) {
    // output data of each row
    $row = $result->fetch_assoc();
    // user ist bereit existirt
   $iduser=$row['IDUser'];

  }else {
    // user anlegen
    $staat=$_POST['inputState'];

    $sql = "
    INSERT INTO tbl_test2_user (Emailadresse, PWD, Vorname,Nachname,GebDatum,Adresse,FIDStaat)
VALUES (
  '".$conn->real_escape_string($_POST['inputEmail4'])."',
   '". $conn->real_escape_string($_POST['inputPassword4'])."',
    '". $conn->real_escape_string($_POST['inputVoranme'])."',
    '". $conn->real_escape_string($_POST['inputNachname'])."',
    '". $conn->real_escape_string($_POST['inputGeb'])."',
    '". $conn->real_escape_string($_POST['inputAddress'])."',
      '". $conn->real_escape_string($staat)."'


    )";
    te($sql);

if ($conn->query($sql) === TRUE) {
  $msg= "<p>ihre Datensatz sind erfolgreich eingtragen</p>";
} else {
  $msg= "<p>ihre Datensatz konnte leider nicht erfolgreich eingtragen werden</p> " . $sql . "<br>" . $conn->error;
}

  }
}


function statten(){
  global $conn;
  $r='<select id="inputState" name="inputState" class="form-select"><option selected>-</option>';

  $sql="
    SELECT * from tbl_staat
  ";
  $staaten = $conn->query($sql)or die("Felher in der Query:" . $conn->error);

if ($staaten->num_rows > 0) {
  // output data of each row
  while($staat = $staaten->fetch_assoc()) {
    //te($staat);
      $r.= '
    <option value='. $staat['IDStaat'] .' >'. $staat['Bezeichnung'].'</option>
    ';
  }

}
  $r.='</select>';
  return $r;
}
//____________________________________________________________________________________


 ?>
 <!DOCTYPE html>
 <html lang="de" >
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

     <title></title>
     <style media="screen">
     .center {
    margin: auto;
    width: 50%;
    border: 2px solid gray;
    padding: 10px;
    margin-top: 2rem;
    margin-bottom: 2rem;
    }
    *{
      box-sizing: border-box;
    }
     </style>
   </head>
   <body>
     <div class="center">


     <form class="row g-3" method="post">
       <div class="col-12">
         <label for="inputVoranme" class="form-label">Vorname:</label>
         <input type="text" class="form-control" name="inputVoranme" id="inputVoranme" placeholder="Vorname">
       </div>
       <div class="col-12">
         <label for="inputNachname" class="form-label">Nachname:</label>
         <input type="text" class="form-control" name="inputNachname" id="inputNachname" placeholder="Nachname">
       </div>
       <div class="col-12">
         <label for="inputGeb" class="form-label">GebDatum:</label>
         <input type="date" class="form-control" name="inputGeb" id="inputGeb" placeholder="GebDatum">
       </div>
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Email</label>
    <input type="email" class="form-control" name="inputEmail4" id="inputEmail4">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Password</label>
    <input type="password" class="form-control" name="inputPassword4" id="inputPassword4">
  </div>

  <div class="col-12">
    <label for="inputAddress" class="form-label">Address</label>
    <input type="text" class="form-control" name="inputAddress" id="inputAddress" placeholder="1234 Main St">
  </div>
  <div class="col-12">
  <label  class="form-label">Geschlecht: </label>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="Geschlecht" value="w" id="flexRadioDefault1">
  <label class="form-check-label" for="flexRadioDefault1">
    Weiblich
  </label>
</div>
<div class="form-check">
<input class="form-check-input" type="radio" name="Geschlecht" value="m" id="flexRadioDefault2">
<label class="form-check-label" for="flexRadioDefault2">
  Mänlich
</label>
</div>

<div class="form-check">
  <input class="form-check-input" type="radio" name="Geschlecht" value="o" id="flexRadioDefault3" checked>
  <label class="form-check-label" for="flexRadioDefault3">
  other
  </label>
</div>
</div>
  <div class="col-12">
    <label for="inputState" class="form-label">Staat</label>
    <?php echo statten(); ?>
  </div>
  <div class="col-12">
    <input type="submit"  class="form-control" name="" value="Sign in">
  </div>
</form>
     </div>
   </body>
 </html>
