<!DOCTYPE html>
<html>
<head>
	<title>Latihan 1c</title>

	<style>
		.kotakBesar {
			border: 1px solid black;
			width: auto;
			height: auto; 
			float: left;
			background-color: bisque;
		}

		.kotakKecil {
			border: 1px solid black;
			width: 50px;
			height: 50px;
			line-height: 50px;
			margin: 5px;
			display: inline-block;
			text-align: center;
			transition: 1s;
			animation: random 1s infinite;
		}

		@keyframes  random {
	    15% { background-color: salmon; } 
	    45% { background-color: lime; } 
	    75% { background-color: aquamarine; }
}

		.kotakKecil:hover {
			transform: rotate(360deg);
		}

		.clear {
			clear: both;
		}
	</style>
</head>
<body>
	<h3>regular</h3>
	<div class="kotakBesar">
		<?php
			$foo = "A";
			$bar = "B";
			$baz = "C";

			echo '<div class="kotakKecil">' . $foo . '</div>';
			echo '<div class="kotakKecil">' . $foo . '</div>';
			echo '<div class="kotakKecil">' . $foo . '</div>';

			echo '<br>';
			echo '<div class="kotakKecil">' . $bar . '</div>';
			echo '<div class="kotakKecil">' . $bar . '</div>';

			echo '<br>';
			echo '<div class="kotakKecil">' . $baz . '</div>';
		?>
	</div>

	<div class="clear"></div>
	<hr>
	<h3>forloop, array</h3>
	<div class="kotakBesar">
		<?php
		$foo = 10; // baris
		$bar = 10; // kolom
		$baz = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");

		for($i = 0; $i < $foo; $i++)
		{
			for($j = 0; $j < $bar; $j++)
			{
				echo '<div class="kotakKecil">' . $baz[$i] . '</div>';
			}

			echo '<br>';
			$bar--;
		}
		?>
	</div>

</body>
</html>