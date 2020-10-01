<?php
  if (session_status() == PHP_SESSION_NONE) {
      session_start();
  }
  
  if (!isset($_SESSION['userid'])) 
    die(header('Location: index.php'));

  require_once('php/settings.php');
  require_once('php/header.php');
  require_once('php/navbar.php');
	
  require_once('php/modal.php');
  require_once('php/sphonestore.php');
  
  if(!isset($_GET['id']))
    die(header('Location: index.php'));
  else {
    if(!CheckProductExists($_GET['id'])) {
      die(header('Location: index.php'));
    }
  }

  require_once('php/loadingmodal.php');
?>

<!DOCTYPE html>
<html>
<head>
  <title>New Product</title>
</head>

<body id="editProductPage">
	<input type="hidden" class="productid" value="<?= $_GET['id'] ?>">
  <input type="hidden" class="userid" value="<?= $_SESSION['userid'] ?>">
  
	<div class="content">
		<div class="row">

			<!-- Back -->
			<div class="col s4">
				<a href="shop.php"><button class="waves-effect waves-indigo btn indigo"> < Back </button> </a>
			</div>

			<div class="col s12">
					<div class="newProduct">
						<div class="row">
							<div class="contentItem">
								<h6>Product Information</h6>
								<hr>
								<h6>Product Images</h6>
								<!-- Product images -->					
								<input multiple type="file" id="imageBrowser" name="imageBrowser" style="display: none" accept="image/png, image/jpg">
								<div class="row">
									<div class="contentItem">
										<div class="contentCardList">
											<div class="col s2">
												<div class="cardContent">
													<label for="imageBrowser">
														<div class="addImage addCard valign-wrapper"><p class="flow-text">+</p></div>
													</label>
												</div>
											</div>

											<!-- Product cards -->
											<span class="imagePreview">
											</span>

										</div>
									</div>		
								</div>

								<p class="smaller-text">Only <b>jpg</b>, <b>png</b> format are allowed</p>
								<p class="smaller-text">Max of <b>1</b> MB</p>
								<p class="smaller-text"><b>5</b> Picture max</p>
								<p class="smaller-text bottom-gap"><b>Tips</b>: Image is 1:1 ratio, the first image will be shown on the listing</p>
								
							</div>
						</div>

						<div class="row">
							<div class="contentItem">
								<!-- Product name -->
								<div class="input-field col s12">
									<input id="productName" class="productName" type="text" data-length="128" maxlength="128">
									<label for="productName">Product Name</label>
								</div>

								<!-- Product SKU -->
								<div class="input-field col s12">
									<input id="productSKU" class="productSKU" type="text" maxlength="16">
									<label for="productSKU">Product SKU</label>
								</div>

								<!-- Product Stock -->
								<div class="input-field col s8">
									<input id="productStock" class="productStock" type="number" maxlength="4">
									<label for="productStock">Product Stock</label>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="contentItem">
								<h6>Product Description</h6>
								<hr>

								<!-- Product description -->
								<div class="input-field col s12">
									<textarea id="productDescription" class="materialize-textarea productDescription" data-length="2048" maxlength="2048"></textarea>
									<label for="productDescription">Product Description</label>
								</div>

								<!-- Product Condition -->
								<h6>Product Condition</h6>
								<div class="col s12">
									<p class="inlineRadio">
										<label>
											<input class="with-gap condition" name="productCondition" type="radio" value="1" />
											<span>New</span>
										</label>
									</p>

									<p class="inlineRadio">
										<label>
											<input class="with-gap condition" name="productCondition" type="radio" value="2" />
											<span>Used</span>
										</label>
									</p>

									<p class="inlineRadio">
										<label>
											<input class="with-gap condition" name="productCondition" type="radio" value="3" />
											<span>Refurbished</span>
										</label>
									</p>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="contentItem">
								<h6>Product Price, Weight & Delievery</h6>
								<hr>

								<!-- Product price -->
								<div class="input-field col s2">
									<input id="rupiahSymbol" type="text" value="Rp " disabled>
								</div>

								<div class="input-field col s10">
									<input id="productPrice" class="productPrice" type="number" min="1000">
									<label for="productPrice">Product Price</label>
								</div>

								<!-- Product weight -->
								<div class="input-field col s2">
									<input id="weightSymbol" type="text" value="g" disabled>
								</div>

								<div class="input-field col s10">
									<input id="productWeight" class="productWeight" type="number" min="1" max="1000">
									<label for="productWeight">Product Weight</label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="contentItem">
								<div class="col s12">
									<button class="waves-effect waves-red btn red deleteButton">Delete</button> 
								</div>

								<!-- Submit -->
								<div class="col s12">
									<button class="waves-effect waves-indigo btn indigo editProductButton disabled">Save</button> 
								</div>

								<div class="col s12">
									<p id="editProductFieldWarning" class="fieldResult leftAlign fieldWarning"></p>
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