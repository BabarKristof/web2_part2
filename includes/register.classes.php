<?php

class Register{
	
	public $fname;
	public $pwd;
	public $pwdRe;
	public $fullname;
	public $email;

public function __construct(){
	 global $conn;
    $this->userid = "";
	$fname="";
	$pwd="";
	$pwdRe="";
	$fullname="";
	$email="";
	$fh_szint=2;
	$lastlogin="";
	$hashedPwd="";
	$fh_aktiv=1;



	if(isset($_POST["regSub"]))
	{
		$fname=$_POST['fname'];
		$pwd=$_POST['pwd'];
		$pwdRe=$_POST['pwdRe'];
		$fullname=$_POST['fullname'];
		$email=$_POST['email'];
		
			$lastlogin=date('y-m-d h:i:s');
	
		$sql = ("SELECT fh_fnev FROM motor_felhasznalok WHERE fh_fnev = ?;");
		$stmt = $conn->prepare($sql);
		$resultCheck = 0;
		
		$stmt->execute(array($fname));
		 if ($stmt->rowCount() != 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
			$resultCheck = 1;
		 }
		else{
			$resultCheck = 2;
		}
		
		
		
		if($resultCheck == 2 & $pwd == $pwdRe){
		

			
			$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
			
		
				$sql = ('INSERT INTO motor_felhasznalok (fh_fnev,fh_jelszo,fh_tnev,fh_email,fh_aktiv,fh_szint,fh_lastlogin) VALUES (?,?,?,?,?,?,?);');
				$stmt = $conn->prepare($sql);
					
				if(!$stmt->execute(array($fname,$hashedPwd,$fullname,$email,$fh_aktiv,$fh_szint,$lastlogin))){
							$stmt = null;
							header("location: ../index.php?error=stmtfailed");
							exit();
				}		
						$stmt=null;
						
		}
	}
}

}
	





?>



