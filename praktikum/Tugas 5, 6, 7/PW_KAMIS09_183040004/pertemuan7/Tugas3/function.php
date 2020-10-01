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

	function tambah($data)
	{
		$conn = koneksi();

		$nama = htmlspecialchars($data['nama']);
		$chipset = htmlspecialchars($data['chipset']);
		$internal = htmlspecialchars($data['internal']);
		$camera = htmlspecialchars($data['camera']);
		$sensor = htmlspecialchars($data['sensor']);
		$gambar = htmlspecialchars($data['gambar']);

		$queryTambah = "INSERT INTO smartphone VALUES ('', '$nama','$chipset', '$internal', '$camera', '$sensor', '$gambar')";

		mysqli_query($conn, $queryTambah);

		return mysqli_affected_rows($conn);
	}

	function hapus($id)
	{
		$conn = koneksi();
		mysqli_query($conn, "DELETE FROM smartphone WHERE id = $id");

		return mysqli_affected_rows($conn);
	}

	function ubah($data) {
		$conn = koneksi();

		$id = $data['id'];
		$nama = htmlspecialchars($data['nama']);
		$chipset = htmlspecialchars($data['chipset']);
		$internal = htmlspecialchars($data['internal']);
		$camera = htmlspecialchars($data['camera']);
		$sensor = htmlspecialchars($data['sensor']);
		$gambar = htmlspecialchars($data['gambar']);

		$queryUbah = "UPDATE smartphone SET name = '$nama',
						chipset = '$chipset',
						internal = '$internal',
						camera = '$camera',
						sensor = '$sensor',
						image = '$gambar'
						WHERE id = '$id'";

		mysqli_query($conn, $queryUbah);

		return mysqli_affected_rows($conn);
	}
?>