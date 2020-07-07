<?php
    session_start(); // harus ada di bagian paling atas kode
    include 'koneksi.php';
    $user = strip_tags(trim($_POST['userid'])); #echo $user;
    $pass = strip_tags(trim($_POST['passwd'])); #echo $pass;

    if($user!='' and $pass!='') {
        $q = mysqli_query($koneksi, "SELECT user_id, password, level 
                 FROM user WHERE username = '".$user."'");

        while ($hasil = mysqli_fetch_array($q)) {
            $dpass = $hasil['password'];
            $s_id  = $hasil['user_id'];
            $level = $hasil['level'];
        }
        
        if($pass==$dpass) {         
            unset($_POST); // hapus post form

// mengisi session
            $_SESSION['s_id']   = $s_id; 
            $_SESSION['s_level']= $level;
            $_SESSION['s_user'] = $user;
            $_SESSION['s_pass'] = $dpass;
            header("location:.");
        }
        else {
          $konfirmasi = 'User ID atau Password Anda Salah';
          header("location:login.php?konfirmasi=".$konfirmasi);
        }
    }
    else {
          $konfirmasi = 'User ID atau Password Tidak Boleh Kosong';
          header("location:login.php?konfirmasi=".$konfirmasi);
    }
