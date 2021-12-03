
<html>
<head>
  <title>AJAX példák</title>
  
  <script type="text/javascript" src="js2/jquery.min.js"></script> 
  <script type="text/javascript" src="js2/ajax.js"></script>
 

  <style>
    #informaciosdiv {
      width: 400px;
    }
    #intezmenyinfo {
      float: right;
      border: 1px solid black;
      width: 190px;
      height: 100px;
    }
    .cimke{
      display: inline-block;
      width: 60px;
      text-align: right;
    }
    span {
      margin: 3px 5px;
    }
    label {
      display: inline-block;
      width: 70px;
      text-align: right;
    }
    select {
      width: 115px;
    }
  </style>
</head>
<body>
  <h2>Ajax lekérdezés</h2>
  <!--<h1>Felső fokú intézmények:</h1>-->
    <div id = 'informaciosdiv'>
      <div id = 'intezmenyinfo'>
        <span class="cimke">Név:</span><span id="nev" class="adat"></span><br>
        <span class="cimke">Cím:</span><span id="cim" class="adat"></span><br>
        <span class="cimke">Telefon:</span><span id="tel" class="adat"></span><br>
        <span class="cimke">E-mail:</span><span id="mail" class="adat"></span><br>
      </div>
      <label for='helysegcimke'>Helyseg:</label>
      <select id = 'helysegselect'></select>
      <br><br>
      <label for = 'szalloda'>Szalloda:</label>
      <select id = 'szallodaselect'></select>
      <br><br>
      <label for = 'tavaszcimke'>Tavasz:</label>
      <select id = 'tavaszselect'></select>
    </div>
    

</body>
</html>
