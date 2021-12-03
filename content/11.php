<?php
$url = "http://localhost/web2bea2_v1/includes/szerver.php";
$result = "";
if(isset($_POST['az']))
{
  // Felesleges szóközök eldobása
  $_POST['az'] = trim($_POST['az']);
  $_POST['nev'] = trim($_POST['nev']);
  $_POST['orszag'] = trim($_POST['orszag']);

  
  // Ha nincs id és megadtak minden adatot (családi név, utónév, bejelentkezési név, jelszó), akkor beszúrás
  if($_POST['az'] == "" && $_POST['nev'] != "" && $_POST['orszag'] != "")
  {
      $data = Array("nev" => $_POST["nev"], "orszag" => $_POST["orszag"]);
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $result = curl_exec($ch);
      curl_close($ch);
  }
  
  // Ha nincs id de nem adtak meg minden adatot
  elseif($_POST['az'] == "")
  {
    $result = "Hiba: Hiányos adatok!";
  }
  
  // Ha van id, amely >= 1, és megadták legalább az egyik adatot (családi név, utónév, bejelentkezési név, jelszó), akkor módosítás
  elseif($_POST['az'] >= 1 && ($_POST['nev'] != "" || $_POST['orszag'] != "" ))
  {
      $data = Array("az" => $_POST["az"], "nev" => $_POST["nev"], "orszag" => $_POST["orszag"]);
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $result = curl_exec($ch);
      curl_close($ch);
  }
  
  // Ha van id, amely >=1, de nem adtak meg legalább az egyik adatot
  elseif($_POST['az'] >= 1)
  {
      $data = Array("az" => $_POST["az"]);
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $result = curl_exec($ch);
      curl_close($ch);
  }
  
  // Ha van id, de rossz az id, akkor a hiba kiírása
  else
  {
    echo "Hiba: Rossz azonosító (Id): ".$_POST['az']."<br>";
  }
}

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$tabla = curl_exec($ch);
curl_close($ch);

?>

    <?= $result ?>
    <h1>Felhasználók:</h1>
    <?= $tabla ?>
    <br>
    <h2>Módosítás / Beszúrás</h2>
    <form method="post">
    Id: <input type="text" name="az"><br><br>
    Helynév: <input type="text" name="nev" maxlength="45">
    Orszszágnév: <input type="text" name="orszag" maxlength="22">
    <input type="submit" value = "Küldés">
    </form>


