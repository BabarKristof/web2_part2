<?php
    switch($_POST['op'])  {
        case'helyseg':
            $eredmeny = array("lista"  => array());
            try {
                $dbh = new PDO('mysql:host=localhost;dbname=web2', 'root', '',
                    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
                $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
                $stmt = $dbh->query("SELECT az, nev FROM helyseg");
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $eredmeny["lista"][] = array("id" => $row['az'], "nev" => $row['nev']);
                }
            } catch (PDOException $e) {
            }
            echo json_encode($eredmeny);
            break;
        case 'szalloda':
            $eredmeny = array("lista" => array());
            try {
                $dbh = new PDO('mysql:host=localhost;dbname=web2', 'root', '',
                    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
                $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
                
                $stmt = $dbh->prepare("SELECT az, nev FROM szalloda WHERE helyseg_az = :id");
                $stmt->execute(Array(":id" => $_POST["id"]));
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    
                    $eredmeny["lista"][] = array("id" => $row['az'], "nev" => $row['nev']);
              }
            } catch (PDOException $e) {
            }
            echo json_encode($eredmeny);
            break;
        case 'tavasz':
            $eredmeny = array("lista" => array());
            try {

                $dbh = new PDO('mysql:host=localhost;dbname=web2', 'root', '',
                    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
                $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
                
                $sql = "SELECT szalloda_az, indulas FROM `tavasz` WHERE szalloda_az = '%".$_POST["id"]."%'";
                //$sth = $dbh->prepare($sql);
                //$sth->execute(array());

                $stmt = $dbh->prepare($sql); 
                $stmt->execute(Array(":id" => $_POST["id"]));
                
                //$stmt->execute(Array(":id" => $_POST["id"]));
                
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $eredmeny["lista"][] = array("id" => $row['id'],"indulas" => $row['indulas']);
              }
            } catch (PDOException $e) {
            }
            echo json_encode($eredmeny);
            break;
        case 'info':
            $eredmeny = array("szalloda_az" => "", "indulas" => "", "idotartam" =>"", "ar" => "");
            try {
                $dbh = new PDO('mysql:host=localhost;dbname=web2', 'root', '',
                    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
                $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
                $stmt = $dbh->prepare("SELECT szalloda_az, indulas, idotartam, ar FROM tavasz where szalloda_az = :id");
                $stmt->execute(Array(":id" => $_POST["id"]));
                if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $eredmeny = array("indulas" => $row['indulas'], "idotartam" => $row['idotartam'], "ar" => $row['ar']);
              }
            } catch (PDOException $e) {
            }
            echo json_encode($eredmeny);
            break;

    }




?>