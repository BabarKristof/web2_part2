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
				$sql2="SELECT szalloda.nev as Anev,helyseg.nev as Bnev,szalloda.besorolas,szalloda.tengerpart_tav,szalloda.repter_tav,szalloda.felpanzio,tavasz.ar
				FROM ((szalloda INNER JOIN helyseg ON helyseg.az=szalloda.helyseg_az) INNER JOIN tavasz ON szalloda.az=tavasz.szalloda_az) 
					WHERE helyseg.az=szalloda.helyseg_az 
					AND helyseg.orszag LIKE '".$alt."' 
					AND besorolas LIKE ".$alt2." 
					AND tavasz.ar < 100000";
					$alt3 = "Kevesebb mint: 100 000";
			} else if ($alt3 == 2){
				$sql2="SELECT szalloda.nev as Anev,helyseg.nev as Bnev,szalloda.besorolas,szalloda.tengerpart_tav,szalloda.repter_tav,szalloda.felpanzio,tavasz.ar
				FROM ((szalloda INNER JOIN helyseg ON helyseg.az=szalloda.helyseg_az) INNER JOIN tavasz ON szalloda.az=tavasz.szalloda_az) 
					WHERE helyseg.az=szalloda.helyseg_az 
					AND helyseg.orszag LIKE '".$alt."' 
					AND besorolas LIKE ".$alt2." 
					AND tavasz.ar > 100000 AND tavasz.ar < 300000";
					$alt3 = "100 000 és 300 000 Között";
			} else {
				$sql2="SELECT szalloda.nev as Anev,helyseg.nev as Bnev,szalloda.besorolas,szalloda.tengerpart_tav,szalloda.repter_tav,szalloda.felpanzio,tavasz.ar
				FROM ((szalloda INNER JOIN helyseg ON helyseg.az=szalloda.helyseg_az) INNER JOIN tavasz ON szalloda.az=tavasz.szalloda_az) 
					WHERE helyseg.az=szalloda.helyseg_az 
					AND helyseg.orszag LIKE '".$alt."' 
					AND besorolas LIKE ".$alt2." 
					AND tavasz.ar > 300000";
				$alt3 = "Több mint: 300 000";
			}
			

			
	
			$stmt2 = $conn->prepare($sql2);
			$stmt2->execute();
			$data2 = $stmt2->fetchAll();
			
			$adatok ="";
			foreach ($data2 as $row2){
				 $adatok.="<p>".$row2['Anev'].", ".$row2['Bnev'].", ".$row2['besorolas'].", ".$row2['tengerpart_tav'].", 
				 ".$row2['repter_tav'].", ".$row2['felpanzio'].", ".$row2['ar']."</p>";
			}
			
						ob_start();
						require_once('./tcpdf/tcpdf.php');
						
						$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
						$pdf->SetCreator(PDF_CREATOR);
						$pdf->SetAuthor('Web-programozás II');
						$pdf->SetTitle('Szállások');
						$pdf->SetSubject('Web-programozás II - 2. Beadandó - TCPDF');
						$pdf->SetKeywords('TCPDF, PDF, Web-programozás II, Beadando 2');
						
					
						$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
						$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

						$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
						
						$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
						$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
						$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
						
						$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
						$pdf->SetFont('helvetica', '', 10);

						$pdf->AddPage();

						 
							$html ='<html>
							  <head>
							  <style>
										table {border-collapse: collapse;}
										th {font-weight: border: 1px solid red; text-align: center;}
										td {border: 1px solid blue;}
									  
							  </style>
							  </head>
							  <body>
								<p>WEB2 Második beadandó</p>
								<p>Szállodák a megadott paraméterekkel(Ország: '.$alt.', Értékelés:  '.$alt2.', Ár: '.$alt3.') '.$adatok.'</p>
							  </body>
							  </html>';
						$pdf->writeHTML($html, true, false, true, false, '');
							

							$pdf->Output('WEB2Beadando2_Szallodak.pdf', 'D');
							exit;
			
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
		<table><tr>
		  <td><select name="orszagok">
				<?php 
				echo $pdfM->Lekerdez1();
				?>
			 </select></td>
			 <td><select name="besorolasok">
				<option value=5>5</option>
				<option value=4>4</option>
				<option value=3>3</option>
				<option value=2>2</option>
				<option value=1>1</option>
			 </select></td>
			<td><select name="arak">
				<option value=1>100 000 alatt</option>
				<option value=2>100 000 - 300 000</option>
				<option value=3>300 000 felett</option>
			 </select></td>
            <td><input type="submit" value="PDF Készítés" name="PDF_Sub" /><br clear="all" /></td>
		</tr></table>	
          </form>
        </div>
      </div>

