<?php
    // koneksi ke mysql, dan memilih database0
    // hostname, username, password, nama database
    $conn = mysqli_connect('localhost', 'root', '', 'pw_183040004');

    function query($query)
    {
        global $conn;

        // query ke tabel mahasiswa
        $result = mysqli_query($conn, $query);
        
        // ambil data dari dalam $result
        // mysqli_fetch_row // array numerik
        // mysqli_fetch_assoc // array associative
        // mysqli_fetch_array // 2-2nya
        $rows = [];
        while($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }

        return $rows;
    }

    function tambah($data)
    {
        global $conn;

        $nrp = htmlspecialchars($data['nrp']);
        $nama = htmlspecialchars($data['nama']);
        $email = htmlspecialchars($data['email']);
        $jurusan = htmlspecialchars($data['jurusan']);

        $query = "INSERT INTO mahasiswa VALUES
                    ('', '$nrp', '$nama', '$email', '$jurusan')";

        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function ubah($data)
    {
        global $conn;

        $id = $data['id'];
        $nrp = htmlspecialchars($data['nrp']);
        $nama = htmlspecialchars($data['nama']);
        $email = htmlspecialchars($data['email']);
        $jurusan = htmlspecialchars($data['jurusan']);

        $query = "UPDATE mahasiswa SET
                     nrp = '$nrp',
                     nama = '$nama',
                     email = '$email',
                     jurusan = '$jurusan'
                     WHERE id = $id";

        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function hapus($id)
    {
        global $conn;

        mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
        return mysqli_affected_rows($conn);
    }
?>