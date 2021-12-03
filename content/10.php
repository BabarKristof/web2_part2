<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);
ini_set('display_startup_errors', 1);

class GrafData{

	public $hotelNames="";
	public $hotelTav="";
	public function GrafKiir(){
		global $conn;

	
	$sql="SELECT nev, tengerpart_tav FROM szalloda";

			$stmt = $conn->prepare($sql);
			$stmt->execute();
			$data = $stmt->fetchAll();
			
		$tmp = array_map(function($x){
			return "'".$x['nev']."'";
		}, $data);
	
	$this->hotelNames= "[".implode(", ",$tmp)."]";
	
	$tmp2 = array_map(function($y){
			return "'".$y['tengerpart_tav']."'";
		}, $data);
	
	$this->hotelTav= "[".implode(", ",$tmp2)."]";
	
	
	}
	

		
		
}
$grafInfo = new GrafData();
$grafInfo->GrafKiir();

?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<canvas id="myChart" width="300" height="300"></canvas>
<script>
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels:<?php echo $grafInfo->hotelNames; ?>,
        datasets: [{
            label: 'Tengerpart Táv',
            data:<?php echo $grafInfo->hotelTav; ?>,
            backgroundColor: [
                'rgba(205,133,30, 0.5)',
                'rgba(205,133,40, 0.5)',
                'rgba(205,133,50, 0.5)',
                'rgba(205,133,60, 0.5)',
                'rgba(205,133,70, 0.5)',
                'rgba(205,133,80, 0.5)',
            ],
            borderColor: [
                'rgba(205,133,30, 1)',
                'rgba(205,133,40, 1)',
                'rgba(205,133,50, 1)',
                'rgba(205,133,60, 1)',
                'rgba(205,133,70, 1)',
                'rgba(205,133,80, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
 
 

 