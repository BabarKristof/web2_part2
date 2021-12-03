<!DOCTYPE html>
<html>
<head>
  <meta name="keywords" content="Web-programozás II.">
  <meta charset="utf-8">
  <title><?php echo $page->GetPageTitle(); ?>WEB2</title>
  <link rel="stylesheet" type="text/css" href="style/style.css" media="screen">
  <link rel="stylesheet" type="text/css" href="style/superfish.css" media="screen">
  <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
  <script type="text/javascript" src="js/superfish.js"></script>
  
  <script type="text/javascript">
    // initialise plugins
    jQuery(function(){
      jQuery('ul.sf-menu').superfish();
    });
  </script>
</head>
<body>
  <div id="wrapper">
    <div id="header-wrapper">
      <div id="header">
        <div id="logo">
          <h1><a href="."><span>Web</span>2</a></h1>
          <h4> Második beadandó </h4>
	<h4> Babar Kristóf és Fehér Donát </h4>
        </div>
        <div id="menu">
          <?php
            echo $page->GetPageMenu();
          ?>
        </div>
      </div>
    </div>
    <!-- end #header -->
    <div id="page">
      <div id="page-bgtop">
        <div id="page-bgbtm">
          <div id="content">
            <?php
              include("content/".$pid.".php");
            ?>
            <div style="clear: both;">&nbsp;</div>
          </div>
          <!-- end #content -->
          <div id="sidebar">
            <ul>
              <li>
               
                <div style="clear: both;">&nbsp;</div>
              </li>
              <?php
                echo $page->GetSidebarMenu();
              ?>
            </ul>
          </div>
          <!-- end #sidebar -->
          <div style="clear: both;">&nbsp;</div>
        </div>
      </div>
    </div>
    <!-- end #page -->
  </div>

  <!-- end #footer -->
</body>
</html>