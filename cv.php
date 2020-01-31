<?php

// Database configuration, Insert your own, Create table using table.sql file
$dbHost     = "";
$dbUsername = "";
$dbPassword = "";
$dbName     = "";

try {
  $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

  if (isset($_POST['submit'])) {
    $fileToUpload = $_FILES['fileToUpload']['name'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $bday = $_POST['bday'];
    $email = $_POST['email'];

    $language = $_POST['language'];
    $lanSpeak = $_POST['lanSpeak'];
    $lanRead = $_POST['lanRead'];
    $lanWrite = $_POST['lanWrite'];

    $eduName = $_POST['eduName'];
    $eduFrom = $_POST['eduFrom'];
    $eduTo = $_POST['eduTo'];
    $eduSpec = $_POST['eduSpec'];

    $languageArray = json_encode($language, JSON_UNESCAPED_UNICODE);
    $lanSpeakArray = json_encode($lanSpeak, JSON_UNESCAPED_UNICODE);
    $lanReadArray = json_encode($lanRead, JSON_UNESCAPED_UNICODE);
    $lanWriteArray = json_encode($lanWrite, JSON_UNESCAPED_UNICODE);
    $eduNameArray = json_encode($eduName, JSON_UNESCAPED_UNICODE);
    $eduFromArray = json_encode($eduFrom, JSON_UNESCAPED_UNICODE);
    $eduToArray = json_encode($eduTo, JSON_UNESCAPED_UNICODE);
    $eduSpecArray = json_encode($eduSpec, JSON_UNESCAPED_UNICODE);

    if(isset($_FILES['fileToUpload'])) {
      $allow = array("jpg", "jpeg", "gif", "png");
      $file_tmp =$_FILES['fileToUpload']['tmp_name'];
      $file_name = $_FILES['fileToUpload']['name'];
      move_uploaded_file($file_tmp,"images/".$file_name);
    }

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO CV
    (fileToUpload, name, surname, bday, email, language, lanSpeak, lanRead, lanWrite, eduName, eduFrom, eduTo, eduSpec)
    VALUES ('$fileToUpload', '$name', '$surname', '$bday', '$email', '$languageArray', '$lanSpeakArray', '$lanReadArray', '$lanWriteArray', '$eduNameArray', '$eduFromArray', '$eduToArray', '$eduSpecArray')";

    $conn->exec($sql);

    $conn = null;

  } else {
    $id = $_GET['id'];
    $sth = $conn->prepare("SELECT * FROM CV WHERE id='$id'");
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_ASSOC);

    $fileToUpload = $result['fileToUpload'];
    $name = $result['name'];
    $surname = $result['surname'];
    $bday = $result['bday'];
    $email = $result['email'];

    $language = json_decode($result['language']);
    $lanSpeak = json_decode($result['lanSpeak']);
    $lanRead = json_decode($result['lanRead']);
    $lanWrite = json_decode($result['lanWrite']);

    $eduName = json_decode($result['eduName']);
    $eduFrom = json_decode($result['eduFrom']);
    $eduTo = json_decode($result['eduTo']);
    $eduSpec = json_decode($result['eduSpec']);

  }

  ?>
  <head>
    <meta charset="utf-8">
    <title>Generated CV</title>
  </head>
  <link rel="stylesheet" type="text/css" href="/styles/cv.css">
  <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
  <script src="/scripts/cv.js"></script>
  <body>
    <a class="download-button" href="javascript:generatePDF()" >Download PDF</a>
    <div id="pdf-container">
      <img src="data:image/png;base64,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
      " class="logo" alt="logo"/>
      <h1 class="main-title">CV</h1>
      <span class="section-title">Pamatinformācija</span>
      <hr>
      <?php if(isset($fileToUpload) && $fileToUpload != ""){ ?>
        <img class="cv-picture" src="<? echo "images/".$fileToUpload;?>" />
      <? } ?>
      <table class="base-table">
        <tr>
          <td class="table-names">Vārds, Uzvārds: </th>
            <td><strong><?php echo $name." ".$surname; ?></strong></th>
            </tr>
            <?php if(isset($bday) && $bday != null) { ?>
              <tr>
                <td class="table-names">Dzimšanas datums: </td>
                <td><?php echo $bday; ?></td>
              </tr>
            <?php } ?>
            <tr>
              <td class="table-names">E-pasta adrese: </td>
              <td><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></td>
            </tr>
          </table>
          <span class="section-title">Iemaņas un zināšanas</span>
          <hr>
          <h4>Valodu zināšanas</h4>
          <table class="border-table">
            <tr>
              <th></th>
              <th>Valoda</th>
              <th>Runātprasme</th>
              <th>Lasītprasme</th>
              <th>Rakstītprasme</th>
            </tr>
            <?php
            for($i = 0; $i < count($language); $i++){
              $j = $i+1;
              ?>
              <tr>
                <td><?php echo $j.".";?></td>
                <td><?php echo $language[$i];?></td>
                <td><?php echo $lanSpeak[$i];?></td>
                <td><?php echo $lanRead[$i];?></td>
                <td><?php echo $lanWrite[$i];?></td>
              </tr>
            <?php  }  ?>
          </table>
          <span class="section-title">Izglītība</span>
          <hr>
          <?php
          if(isset($eduName) && $eduName !=null){
            for($i = 0; $i < count($eduName); $i++){ ?>
              <table  class="base-table">
                <tr>
                  <td class="table-names">Izglītības iestādes nosaukums: </td>
                  <td><strong><? echo $eduName[$i]?></strong></td>
                </tr>
                <tr>
                  <td class="table-names">Gads no: </td>
                  <td><? echo $eduFrom[$i]?></td>
                </tr>
                <tr>
                  <td class="table-names">Gads līdz: </td>
                  <td><? echo $eduTo[$i]?></td>
                </tr>
                <tr>
                  <td class="table-names">Specialitāte: </td>
                  <td><? echo $eduSpec[$i]?></td>
                </tr>
              </table>
            <? }
          } ?>
        </div>
      </body>
    <? }
    catch(PDOException $e)
    {
      echo $sql . "<br>" . $e->getMessage();
    }
