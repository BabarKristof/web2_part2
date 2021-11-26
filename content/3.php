<?php
  if (!isset($user)) {
    header("location: ../index.php");
  }
?>
        <h2 class="title">Regisztráció</h2>
      <div class="post">
        <div style="clear: both;">&nbsp;</div>
        <div class="entry belepes">
          <form action="." method="post">
            <label><input type="text" id="fname" name="fname" /> Felhasználói név: </label><br clear="all" />
			<label><input type="password" name="pwd" /> Jelszó: </label><br clear="all" />
			<label><input type="password" name="pwdRe" /> Jelszó újra: </label><br clear="all" />
            <label><input type="text" id="fnev" name="fullname" /> Teljes név: </label><br clear="all" />
            <label><input type="text" id="fnev" name="email" /> Email: </label><br clear="all" />     
            <input type="submit" value="Regisztráció" name="regSub" /><br clear="all" />
          </form>
        </div>
      </div>
      
      <script type="text/javascript">
        $("#fnev").focus();
      </script>
