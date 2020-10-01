<?php
	if (session_status() == PHP_SESSION_NONE) {
			session_start();
  }
  
  $menu = 0;
	if(!isset($_GET['m']))
		header('Location: shop.php?m=0');	
	else
		$menu = $_GET['m'];

  $usingGET = false;
  if(isset($_SESSION['userid'])) {
    if(isset($_GET['id'])){
      if($_GET['id'] == $_SESSION['userid']){
        header('Location: shop.php?m=0');
      }	else {
          $id = $_GET['id'];
          $usingGET = true;
      }
    } else {
      $id = $_SESSION['userid'];
    }
  } else {
      if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $usingGET = true;
      } else {
        header('Location: index.php');
      }
  }

  require_once('php/settings.php');
  require_once('php/header.php');
  require_once('php/navbar.php');

  require_once('php/modal.php');

	require_once('php/sphonestore.php');
	if(!CheckUserExists($id))
		header('Location: index.php');

	if($_GET['m'] == 1)
		PDFReport($_SESSION['userid']);

  $miniProfile = json_decode(LoadMiniProfile($id), true);

  $name = $miniProfile['name'];
  $balance = number_format($miniProfile['balance'], 2, ',', '.');
  $points = number_format($miniProfile['points'], 2, ',', '.');
	$membertype = ($miniProfile['membertype']) ? "Premium merchant" : "Regular merchant"; 
	
  $products = json_decode(LoadProfileProduct($id), true);
  
	require_once('php/loadingmodal.php');
	require_once('php/sidenav/shopsidenav.php');
?>

<!DOCTYPE html>
<html>
<head>
  <title>My Shop</title>
</head>

<body>
	<div class="content">
		<!-- User profile side bar -->
		<div class="row">
			<div class="col m4 hide-on-small-only">
				<div class="myAccountMiniProfile">
					<img src="" alt="" class="miniProfilePicture">

					<div class="miniProfileDesc">
						<div>
								<p><b><?= $name ?></b></p>
						</div>

						<div>
								<p class="smaller-text"><?= $membertype ?><p>
						</div>
					</div>   
				</div>

				<div class="myAccountSideBar">
					<!-- Profile -->
					<a href="?m=0">
						<button class="waves-effect waves-indigo btn">
							<div>
								<li class="valign-wrapper">
									<i class="material-icons">card_giftcard</i>
									<span>Product</span>
								</li> 
							</div>
						</button> 
					</a>   

					<?php if(!$usingGET): ?>
						<a href="?m=1">
							<button class="waves-effect waves-indigo btn">
								<div>
									<li class="valign-wrapper">
										<i class="material-icons">picture_as_pdf</i>
										<span>PDF</span>
									</li> 
								</div>
							</button> 
						</a>   
					<?php endif ?>
				</div>
			</div>
			
			<!-- Profile -->
			<?php if($menu == 0): ?>
				<div class="col m8 s12">
					<div class="contentBG">
						<h6><b><?= $name ?></b> Products</h6>
						<hr>

						<div class="row">
              <div class="contentItem">
                <div class="contentCardList">
									<?php if(!$usingGET): ?>
										<div class="col s6 m4 l3">
											<div class="cardContent">
												<a href="newproduct.php">
													<div class="addCard valign-wrapper"><p>+</p></div>
												</a>
											</div>
										</div>
									<?php endif ?>
									
									<!-- Product cards -->
									<?php if($products): ?>
									<?php foreach ($products as $prod): ?>
									<?php 
										$prod = $prod[0];
										$id = $prod['productid'];
										$prodName = $prod['name'];

										$prodStock = $prod['stock'];
										$prodPrice = 'Rp ' . number_format(sprintf("%.2f", $prod['price']), 2, ",", ".");
										$img = json_decode($prod['image'], true);
										$prodImage = $img[0];
										
									?>

										<div class="col s6 m4 l3">
											<a href="product.php?id=<?= $id ?>">
												<div class="cardContent">
												<img src="<?= substr($img[0], 3) ?>" class="cardImage">
												
												<div class="cardInfo">
													<div class="cardInfoContent">
                            <h6 class="truncate"><?= $prodName ?></h6>
                            <hr>
														<p class="smaller-text truncate"><?= $prodPrice ?></p>
														<p class="smaller-text truncate">Stock: <?= $prodStock ?></p>
													</div>
												</div>
											</div>
											</a>
										</div>
									<?php endforeach ?>
									<?php endif ?>
                </div>
              </div>
            </div>

					</div>
				</div>
			<?php endif ?>
		</div>
	</div>

	<?php 
		require_once('php/footer.php');
		require_once('php/javascript.php') 
	?>
</body>
</html>