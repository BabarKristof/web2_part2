<?php
  if (!isset($user)) {
    header("location: ../index.php");
  }

?>
      <div class="post">

        <h2 class="title"><a href=".">Nyitólap</a></h2>
        <p class="meta"><span class="date">2012.03.05.</span><span class="posted">Beküldte: Admin</span></p>
        <div style="clear: both;">&nbsp;</div>
			  <?php var_dump($_SESSION["fname"]); die(); ?>
        <div class="entry">
          <p>This is <strong>LazyBreeze  </strong>, a free, fully standards-compliant CSS template designed by FreeCssTemplates<a href="http://www.nodethirtythree.com/"></a> for <a href="http://www.freecsstemplates.org/"> CSS Templates</a>.  This free template is released under a <a href="http://creativecommons.org/licenses/by/3.0/">Creative Commons Attribution 3.0</a> license, so you’re pretty much free to do whatever you want with it (even use it commercially) provided you keep the links in the footer intact. Aside from that, have fun with it :)</p>
          <p>Sed lacus. Donec lectus. Nullam pretium nibh ut turpis. Nam bibendum. In nulla tortor, elementum ipsum. Proin imperdiet est. Phasellus dapibus semper urna. Pellentesque ornare, orci in felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem.</p>
          <p class="links"><a href="#">Read More</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" title="b0x w">Comments</a></p>
        </div>
      </div>
