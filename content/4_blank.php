<h3>Teszteléshez használja az egyik request funkciót, majd jobb klikk az oldalra és View page sources VAGY nyomja be a CTRL + U shortcut kombinációt.</h3>
<?php


//curl get request
function apiGetRequest(){
    
    $ch = curl_init();

    $url = "https://reqres.in/api/users?page=2";

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $resp = curl_exec($ch);

    if($e = curl_error($ch)) {
    echo $e;
    }
    else {
        $decoded = json_decode($resp, true);
        print_r($decoded);
    }

    curl_close($ch);
}

//curl post request
function apiPostRequest(){

    $url = "https://reqres.in/api/users";
    
    $data_array = array(
        'name' => 'John Doe',
        'job' => 'Web Developer'
    );

    $data = http_build_query($data_array);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $resp = curl_exec($ch);

    if ($e = curl_error($ch)) 
    {
        echo $e; 
    }
    else {
        $decoded = json_decode($resp);
        foreach ($decoded as $key => $val) {
            echo $key . ': ' . $val . '<br>';
        }
    }
    curl_close($ch);
}


//Ugyan az mint a post request csak más az url.
function apiPutRequest() {
    $url = "https://reqres.in/api/users/2";

    
    $data_array = array(
        'name' => 'John Doe',
        'job' => 'Web Developer'
    );

    $data = http_build_query($data_array);

    $header = array(
        'Authorization: asdasdasdasyxc'
    );

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');     //Illetve még ez a sor más
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

    $resp = curl_exec($ch);

    if ($e = curl_error($ch)) 
    {
        echo $e; 
    }
    else {
        $decoded = json_decode($resp);
        foreach ($decoded as $key => $val) {
            echo $key . ': ' . $val . '<br>';
        }
    }
    curl_close($ch);
}

function apiSaveToFile() {
        
  $ch = curl_init();

  $url = "https://reqres.in/api/users?page=2";

  $fh = fopen("../files/file.txt", "w");
  //$fh = fopen("files/file.txt", "w");
  //$filename = 'file.txt';

  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_FILE, $fh);

  curl_exec($ch);

  if($e = curl_error($ch)) {
      echo $e;
  }

  fclose($fh);
  curl_close($ch);
}

function apiDeleteRequest() {
      
  $ch = curl_init();

  $url = "https://reqres.in/api/users/2";

  $data_array = array(
      'name' => 'John Doe',
      'job' => 'Web Developer'
  );

  $data = http_build_query($data_array);

  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $resp = curl_exec($ch);

  if($e = curl_error($ch)) {
     echo $e;
  }
  else {
      $decoded = json_decode($resp, true);
      print_r($decoded);
  }

  curl_close($ch);
}

if(array_key_exists('button1', $_POST)) {
    apiGetRequest();
}
else if(array_key_exists('button2', $_POST)) {
    apiPostRequest();
}
else if(array_key_exists('button3', $_POST)) {
    apiPutRequest();
}
else if(array_key_exists('button4', $_POST)) {
    apiSaveToFile();
    echo '<script>alert("The file save is success.")</script>';
    ?> <p style="margin: 25px"><a href="../files/file.txt"> file.txt</a></p> <?php
}
else if(array_key_exists('button5', $_POST)) {
  apiDeleteRequest();
}

?>
<div style= "margin: 25px">
        <form method="post">
            <input type="submit" name="button1"
                    class="button" value="Get Request" />
            <input type="submit" name="button2"
                    class="button" value="Post Request" />
            <input type="submit" name="button3"
                    class="button" value="Put Request" />
            <input type="submit" name="button4"
                    class="button" value="Save to file" />
            <input type="submit" name="button5"
                    class="button" value="Delete Request" />
        </form>
</div>