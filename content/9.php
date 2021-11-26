<?php
//PDF készítés
error_reporting(E_ALL);
ini_set("display_errors", 1);
ini_set('display_startup_errors', 1);
class PDFMaker{
    private $szalloda;
    private $tavasz;
    private $helyseg;
     
    public function Lekerdez1() {
     global $conn;

	$stmt = $conn->prepare('SELECT orszag FROM helyseg GROUP BY orszag');
	$stmt->execute();
	$data = $stmt->fetchAll();
	
			foreach ($data as $row){
				echo "<option value=".$row["orszag"].">".$row["orszag"]."</option>";
			}
	}
	 

	public function Feldolgoz(){
			global $conn;
		  if(isset($_POST['PDF_Sub'])){
			$alt = $_POST['orszagok'];
			$alt2 = $_POST['besorolasok'];
			$alt3 = $_POST['arak'];

			if($alt3 == 1){
				$sql2="SELECT szalloda.nev FROM ((szalloda INNER JOIN helyseg ON helyseg.az=szalloda.helyseg_az) INNER JOIN tavasz ON szalloda.az=tavasz.szalloda_az) 
					WHERE helyseg.az=szalloda.helyseg_az 
					AND helyseg.orszag LIKE '".$alt."' 
					AND besorolas LIKE ".$alt2." 
					AND tavasz.ar < 100000";
			} else if ($alt3 == 2){
				$sql2="SELECT szalloda.nev FROM ((szalloda INNER JOIN helyseg ON helyseg.az=szalloda.helyseg_az) INNER JOIN tavasz ON szalloda.az=tavasz.szalloda_az) 
					WHERE helyseg.az=szalloda.helyseg_az 
					AND helyseg.orszag LIKE '".$alt."' 
					AND besorolas LIKE ".$alt2." 
					AND tavasz.ar > 100000 AND tavasz.ar < 300000";
			} else {
				$sql2="SELECT szalloda.nev FROM ((szalloda INNER JOIN helyseg ON helyseg.az=szalloda.helyseg_az) INNER JOIN tavasz ON szalloda.az=tavasz.szalloda_az) 
					WHERE helyseg.az=szalloda.helyseg_az 
					AND helyseg.orszag LIKE '".$alt."' 
					AND besorolas LIKE ".$alt2." 
					AND tavasz.ar > 300000";
				
			}
			
	
			$stmt2 = $conn->prepare($sql2);
			$stmt2->execute();
			$data2 = $stmt2->fetchAll();
	
			foreach ($data2 as $row2){
				echo "<p>".$row2['nev']."</p>";
			}
			
			
			
			}	

		}
}

$pdfM = new PDFMaker();
$pdfM ->Feldolgoz();


?>

  <div class="post">
        <h3 class="title">PDF Maker</h3>
        <div style="clear: both;">&nbsp;</div>
        <div class="entry belepes">
          <form action="" method="post">
            <select name="orszagok">
				<?php 
				echo $pdfM->Lekerdez1();
				?>
			 </select>
			 <select name="besorolasok">
				<option value=5>5</option>
				<option value=4>4</option>
				<option value=3>3</option>
				<option value=2>2</option>
				<option value=1>1</option>
			 </select>
			 <select name="arak">
				<option value=1>100 000 alatt</option>
				<option value=2>100 000 - 300 000</option>
				<option value=3>300 000 felett</option>
			 </select>
            <input type="submit" value="PDF Készítés" name="PDF_Sub" /><br clear="all" />
          </form>
        </div>
      </div>

