<?php
    // Avoid user from accessing this file directly
    if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
		die(header('Location: ../index.php'));
?>

<!DOCTYPE html>
<body>
    <!-- Modal -->
	<div class="modal hide">
		<div class="modalContent">
		<!-- Close -->
			<div class="col s12">
                <p class="output"></p>
				<button class="waves-effect waves-indigo btn close">Close</button> 
			</div>
		</div>
	</div> 
</body>
</html>