<?php

if (isset($_GET['page'])) {
    if ($_GET['page'] == 'produk') {
        include 'produk.php';
    } else if ($_GET['page'] == 'about') {
        include 'about.php';
    } else if ($_GET['page'] == 'contact') {
        include 'contact.php';
    } else {
        include 'produk.php';
    }
} else {
    include 'produk.php';
}
