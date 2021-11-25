<?php
  include_once("includes/initial.php");
?><!DOCTYPE html>
<html>
<head>
  <title>AJAX példák</title>
  <script type="text/javascript" src="includes/jquery-2.1.3.min.js"></script>
  <script type="text/javascript">
    function valtozas() {
      var thisKep = $(this);
      var taz     = $(this).attr("id");
      var vel     = Math.random;
      $.ajax({
        url:      "hivott.php",
        data:     {a: taz, sid: vel},
        type:     "GET",
        dataType: "json",
        success: function(valasz) {
          if (valasz.hibakod !== 0) {
            alert("Hiba történt!");
          } else {
            $(thisKep).attr({
              src: valasz.src,
              title: valasz.title
            })
          }
        }
      });
    }
    $(document).ready(function() {
      $(".r_ikon").css("cursor", "pointer").click(valtozas);
    });
  </script>
</head>
<body>
  <h2>Termékek listája</h2>
  <p>
    Kattintson a <em>raktáron</em> ikonra a változtatáshoz!
  </p>
  <?php
    echo tablaMegjelenit();
  ?>
</body>
</html>