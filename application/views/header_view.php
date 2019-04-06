<!doctype html>
<html lang="en">
  <head>
    <title><?php echo $title_web; ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url("css/style.css") ?>">
  </head>
  <body>
    <div class="wrapper">
        <!--- navbar --->
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container">
                <button class="navbar-toggler" data-toggle="collapse" data-target="#menuNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <span class="ml-auto text-white order-last">
                    Welcome, <strong><?php echo $nickname; ?></strong>
                </span>
                <div class="collapse navbar-collapse" id="menuNav">
                    <ul class="navbar-nav mr-auto order-first">
                        <li class="nav-item"><a href="<?php echo base_url(); ?>" class="nav-link">Dashboard</a></li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Katalog Buku</a>
                            <div class="dropdown-menu">
                                <a href="<?php echo base_url("index.php/buku/tambah"); ?>" class="dropdown-item">Tambah Buku</a>
                                <a href="<?php echo base_url("index.php/buku/"); ?>" class="dropdown-item">List Buku</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Peminjam</a>
                            <div class="dropdown-menu">
                                <a href="<?php echo base_url("index.php/peminjam/tambah"); ?>" class="dropdown-item">Tambahkan Peminjam</a>
                                <a href="<?php echo base_url("index.php/peminjam/"); ?>" class="dropdown-item">List Peminjam</a>
                            </div>
                        </li>
                        <li class="nav-item"><a href="<?php echo base_url("index.php/kategori"); ?>" class="nav-link">Kategori</a></li>
                        <li class="nav-item"><a href="<?php echo base_url("index.php/penerbit"); ?>" class="nav-link">Penerbit</a></li>
                        <li class="nav-item"><a href="<?php echo base_url("index.php/home/logout"); ?>" class="nav-link">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>