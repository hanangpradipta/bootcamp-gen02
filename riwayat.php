<?php 

    // MYSQL Connection
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'jual_pulsa';

    $koneksi = mysqli_connect($host, $user, $password, $database);

    if(!$koneksi){
        echo "Error connecting : " . mysqli_error($koneksi);
    }

    // Untuk Mengambil DB table Users (konter)
    function get_db(){
        global $koneksi, $id, $nama, $saldo;
        $query = "SELECT * FROM users WHERE id=1";
        $hasil = mysqli_query($koneksi, $query);
    
        if (mysqli_num_rows($hasil) > 0){
            while ($row = mysqli_fetch_assoc($hasil)){
                $nama = $row['nama'];
                $saldo = $row['saldo'];
                $id =$row['id'];
            }
        }    
        
    }
    
    get_db();

    function rupiah($angka)
    {
        return 'Rp. '.strrev(implode('.',str_split(strrev(strval($angka)),3)));
    }
    $query = "SELECT * FROM konter WHERE id_users = $id";
    $hasil = mysqli_query($koneksi, $query);
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pulsa | Riwayat</title>

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="app">
        <div class="sidebar">
            <h1><i>Admin</i></h1>
            <ul>
                <li><a href="index.php">Top Up</a></li>
                <li><a href="pulsa.php">Transaksi</a></li>
                <li><a class="active" href="riwayat.php">Riwayat</a></li>
            </ul>
        </div>
        <div class="root">
            <div class="nav">
                <h2>
                    <i class="fa-solid fa-wallet" style="color: #256d85;margin-right: 10px;"></i>
                    <?= rupiah($saldo) ?>
                </h2>
                <h3>
                    <?= $nama ?>
                    <i class="fa-solid fa-user" style="color: #fff;margin-left: 10px;padding: 10px;background-color: #256d85;border-radius: 20px;"></i>
                </h3>
            </div>
            <div class="main">
                <div class="box">
                    <h2>Riwayat</h2>
                    <br>
                    <table cellspacing="0">
                        <thead>
                            <tr class="thead">
                                <th>Tanggal</th>
                                <th>No. Telpon</th>
                                <th>Nominal</th>
                                <th>Provider</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($hasil)){ ?>
                            <tr>
                                <td><?= $row['tanggal'] ?></td>
                                <td><?= $row['no_kartu'] ?></td>
                                <td><?= $row['nominal'] ?></td>
                                <td><?= $row['provider'] ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>