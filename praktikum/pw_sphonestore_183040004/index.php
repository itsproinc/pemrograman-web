<?php
  require_once('php/settings.php');
  require_once('php/header.php');
  require_once('php/navbarnomenu.php');
	// require_once('php/indexnavbar.php');
	
	require_once('php/modal.php');
  require_once('php/loadingmodal.php');
  
  require_once('php/sphonestore.php');
  
  $sort;
  if(isset($_GET['s']))
    $sort = $_GET['s'];
  else
    $sort = '';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
</head>

<body id="index">
    <div class="content">
        <input type="hidden" id="sort" value="<?= $sort ?>">

        <div class="row">
            <!-- Back -->
            <div class="input-field col s6">
                <input id="searchBar" type="text">
                <label for="searchBar">Search</label>
            </div>

            <div class="input-field col s3 offset-s3">
                <a class='dropdown-trigger btn' href='#' data-target='dropdown1'>SORT</a>

                <!-- Dropdown Structure -->
                <ul id='dropdown1' class='dropdown-content'>
                    <li><a href="?s=r">Relevance</a></li>
                    <li><a href="?s=az">A-Z</a></li>
                    <li><a href="?s=za">Z-A</a></li>
                    <li><a href="?s=lh">LOW-HIGH</a></li>
                    <li><a href="?s=hl">HIGH-LOW</a></li>
                </ul>
            </div>
        </div>

        <div class="col s12">
            <div class="contentBG">
                <div class="row">
                    <div class="contentItem">
                        <div class="contentCardList">
                            <span class="indexListing"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <?php 
		require_once('php/footer.php');
		require_once('php/javascript.php') 		
	?>
</body>

</html>
