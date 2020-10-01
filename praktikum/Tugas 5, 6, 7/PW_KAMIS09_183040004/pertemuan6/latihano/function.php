<?php 
	function koneksi()
	{
		$conn = mysqli_connect("localhost", "root", "") or die ("Koneksi Gagal!");
		mysqli_select_db($conn, "prak_pw_183040004") or die ("DB Salah!");

		return $conn;
	}

	function query($sql)
	{
		$conn = koneksi();
		$results = mysqli_query($conn, "$sql");

		$rows = [];
		while ($row = mysqli_fetch_assoc($results))
			$rows[] = $row;

		return $rows;
	}
?>