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

    function registrasi($data) {
        global $conn;

        $username = $data['username'];
        $password1 = $data['password1'];
        $password2 = $data['password2'];

        $cek_user = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

        if(mysqli_num_rows($cek_user) > 0) {
            echo "<script>
                alert('Username sudah terdaftar!');
                document.location.href = 'registrasi.php';
                </script>";

                return false;
        }

        if($password1 != $password2) {
            echo "<script>
                alert('Password tidak sama');
                document.location.href = 'registrasi.php';
                </script>";

                return false;
        }

        $password = password_hash($password1, PASSWORD_DEFAULT);
        $created_at = time();
        $query = "INSERT INTO user VALUES ('', '$username', '$password', '$created_at')";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }
?>