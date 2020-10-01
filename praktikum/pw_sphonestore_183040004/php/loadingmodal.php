<?php
    // Avoid user from accessing this file directly
    if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
		die(header('Location: ../index.php'));
?>

<!DOCTYPE html>
<body>
    <!-- Loading modal -->
	<div class="loadingModal hide">
		<div class="loadingModalContent">		
            <div class="preloader-wrapper big active">
                <div class="spinner-layer spinner-indigo-only">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                        <div class="circle"></div>
                    </div><div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
		</div>
	</div> 
</body>
</html>