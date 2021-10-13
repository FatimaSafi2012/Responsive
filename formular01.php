<?php
include("includes/db01.php");
require("includes/config.inc01.php");

$msg="";
if (count($_POST)>0) {
  te($_POST);
  if (count($_FILES)>0) {
    te($_FILES);
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["profilbild"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    //chek file size
    if (file_exists($target_file)) {
      $msg="<p>File ist bereit existiert.</p>";
        $uploadOk = 0;
    }
    //chek file size
    if ($_FILES["profilbild"]["size"]>500000) {
      $msg="<p> sorry , ihre File ist sehr groß</p>";
        $uploadOk = 0;
    }
    // chek file format
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType !="jpeg" && $imageFileType !="gif" && $imageFileType !="pdf") {
      $msg="<p>sorry , es wird nur jpg,png.jpeg,gif,pdf files hochgeladen.</p>";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
      $msg="<p>sorry ihr File ist nicht hochgeladen. überprufen sie die Große oder Format </p>";
    }else {
      if (move_uploaded_file($_FILES["profilbild"]["tmp_name"], $target_file)) {
        $msg="<p>The file ". htmlspecialchars( basename( $_FILES["profilbild"]["name"])). " wurde erfolgreich hochgeladen.</p>";
      }else {
        "<p>sorry Beim hochladen ihre Datei ist ein fehler aufgetretn./p>";
      }
    }

// $gebDatum= $_POST['gebDatum'];
// $gebDatumNeu=date('m.d.y', strtotime($gebDatum));

    $sql = "
    INSERT INTO tbl_test1_personen (Vorname, Nachname, GebDatum,Adresse,PLZ,Ort,FIDStaat,URLProfilbild,Kommentar)
VALUES (
  '". $_POST['Vorname']."',
     '". $_POST['nachname']."',
  '  ". $_POST['gebDatum'] ."',
      '". $_POST['Adresse']."',
        '". $_POST['PLZ']."',
          '". $_POST['Ort']."',
            '". $_POST['staaten']."',
            ' " . $target_file . "',
            '". $_POST['kommentar']."'
  )";


if ($conn->query($sql) === TRUE) {
  echo "<p>Ihre Daten werden erfolgreich in Datenbank gespeichert</p>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}



  }//file

}//post

 ?>
 <!DOCTYPE html>
 <html lang="en">
   <head>
     <meta charset="utf-8">
     <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1">
     <title></title>
     <style media="screen">
     .center {
    margin: auto;
    width: 50%;
    border: 2px solid gray;
    padding: 10px;
    margin-top : 5rem;
    margin-bottom : 5rem;

    }
     </style>
   </head>
   <body>
     <?php echo $msg; ?>
<div class="center">
     <form  action="formular01.php" method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="Vorname" class="form-label">Vorname</label>
    <input type="text" class="form-control" id="Vorname" name="Vorname">
  </div>
  <div class="mb-3">
    <label for="Nachname" class="form-label">Nachname:</label>
    <input type="text" class="form-control" id="Nachname" name="nachname">
  </div>
  <div class="mb-3">
    <label for="gebDatum" class="form-label">Geburtsdatum:</label>
    <input type="date" class="form-control" id="gebDatum" name="gebDatum" placeholder="TT . MM . JJJJ" >
  </div>
  <div class="mb-3">
    <label for="Adresse" class="form-label">Adresse:</label>
    <input type="text" class="form-control" id="Adresse" name="Adresse">
  </div>
  <div class="mb-3">
    <label for="PLZ" class="form-label">PLZ:</label>
    <input type="number" min="0" max="9999" class="form-control" id="PLZ" name="PLZ">
  </div>
  <div class="mb-3">
    <label for="Ort" class="form-label">Ort:</label>
    <input type="text" class="form-control" id="Ort" name="Ort">
  </div>
  <div class="mb-3">
<label for="staaten" class="form-label">Staat:</label>
<select name="staaten" id="staaten" class="form-select">
   <option value="">Bitte wählen: </option>
   <option value="At">Österreich</option>
   <option value="de">Deutschland</option>
   <option value="po">Portugal</option>
  <option value="sp">Spanian</option>
</select>
  </div>
  <div class="mb-3">
    <label for="profilbild" class="form-label">Profilbild:</label>
    <input type="file" class="form-control" id="profilbild" name="profilbild">
  </div>
  <div class="mb-3">
    <label for="kommentar" class="form-label">Kommentar:</label>
    <textarea  class="form-control" id="kommentar" name="kommentar" rows="4" cols="50"></textarea>
  </div>
    <div class="mb-3">
  <input  type="submit" class="form-control" value="abschieken">
    </div>
</form>
</div>
</body>
 </html>
