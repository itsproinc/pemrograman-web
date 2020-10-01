<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
		}
		
		require_once('php/sphonestore.php');
		if(!isset($_GET['id']))
			die(header('Location: index.php'));
		else {
			if(!CheckProductExists($_GET['id'])) {
				die(header('Location: index.php'));
			}
		}
    
		require_once('php/settings.php');
		require_once('php/header.php');
		require_once('php/navbarnomenu.php');
		
		require_once('php/modal.php');
		require_once('php/loadingmodal.php');

		$product = json_decode(LoadProduct($_GET['id']), true);
		$img = json_decode($product['image']);
		$stock = $product['stock'];
		
		$miniProfile = json_decode(LoadMiniProfile($product['userid']), true);
		$prodPrice = 'Rp ' . number_format(sprintf("%.0f", $product['price']), 2, ",", ".");

		$name = $miniProfile['name'];
		$desc = nl2br($product['description']);
		$stockLength = strlen($product['stock']);

		$editable = false;
		if(isset($_SESSION['userid'])) {
			if($_SESSION['userid'] == $product['userid'])
				$editable = true;
		}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Product</title>
</head>

<body id="productPage">	
	<div class="content">
		<div class="row">

			<!-- Back -->
			<div class="col s4">
				<a href="javascript:history.back()"><button class="waves-effect waves-indigo btn indigo"> < Back </button> </a>
			</div>

			<div class="col s12">
				<div class="product contentBG">
					<div class="row">
						<div class="contentItem">
							<!-- Image -->
							<div class="col s12 m5 imgList">
								<div class="contentCardList">
									<div class="col s12">
									  <div class="cardContent">
											<img src="<?= substr($img[0], 3) ?>" class="cardImage materialboxed">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="contentCardList">
										<div class="contentItem">
											
											<?php for ($i=1; $i < count($img); $i++): ?>
											<div class="col s3">
												<div class="cardContent">
													<img src="<?= substr($img[$i], 3) ?>" class="cardImage materialboxed">
												</div>
											</div>
											<?php endfor ?>

										</div>
									</div>
								</div>
							</div>

							<!-- Product info -->
							<div class="col s12 m7">
								<p class="title"><b><?= $product['name'] ?></b></p>
								<p class="medium-text">From: <a href="shop.php?m=0&id=<?= $product['userid'] ?>"> <?= $name ?> </a></p>

								<hr>
								<h6>Price: </h6>
								<div class="text-bg">
									<h5><?= $prodPrice ?></h5>
								</div>

								<h6>Stock available: </h6>
								<div class="text-bg">
									<h5><?= $stock ?></h5>
								</div>
								<hr>
							

								<div class="input-field col s4">
									<input placeholder="0" id="qty" class="qty" type="number" maxlength="<?= $stockLength ?>" min="1" max="<?= $stock ?>">
									<label for="qty">QTY (Max: <?= $stock ?>)</label>
								</div>

								<div class="input-field col s12">
										<button class="waves-effect waves-green btn green buyButton disabled">Buy</button> 
								</div>

							</div>
						</div>
					</div>

					<div class="row">
						<div class="col s12">
							<div class="contentItem">
								<div class="text-bg">
									<p><?= $desc ?></p>
								</div>

								<?php if($editable): ?>
								<a href="editproduct.php?id=<?= $product['productid'] ?>">
									<div class="input-field col s12">
										<button class="waves-effect waves-red btn red">Edit</button> 
									</div>
								</a>
								<?php endif ?>
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