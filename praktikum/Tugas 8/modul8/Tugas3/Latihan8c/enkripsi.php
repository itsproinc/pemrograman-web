<?php
    if(isset($_POST['submit'])) {
        $pass = $_POST['pass'];
        if(!empty($pass)) {
            $password = password_hash($pass, PASSWORD_DEFAULT);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Password Generator</title>
</head>
<body>
	<div class="container-fluid">
		<div class="page-header">
			<h3>Password Generator</h3>
		</div>
		<div class="content">
			<form action="" method="post">
				<table class="loginForm">
					<tr>
						<td><label for="pass" >Password</label></td>
						<td>:</td>
						<td><input type="text" name="pass" id="pass" autosave="off" autocomplete="off"></td>
					</tr>
					<tr>
						<td><label for="pass" >Encrypted Password</label></td>
						<td>:</td>
						<?php if (isset($password)) {  ?>
						<td><input type="text" value="<?php echo $password ?>"></td>
						<?php }else { ?>
						<td><input type="text" disabled></td>
						<?php } ?>

					</tr>					
					<tr>
						<td colspan="3">
							<button type="submit" name="submit" class="btn btn-success"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Generate</button>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</body>
</html>