<?php
//phpinfo();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// konfigurasi koneksi
$host       =  "10.90.252.21";
$dbuser     =  "geonode";
$dbpass     =  "Geojombang123_";
$port       =  "5432";
$dbname    =  "geonode_data";



// script koneksi php postgree
$link = new PDO("pgsql:dbname=$dbname;host=$host", $dbuser, $dbpass);

print_r( $link);
// if ($link) {
//      echo "Koneksi Berhasil";
// } else {
//      echo "Gagal melakukan Koneksi";
// }

// echo "yyy";


$db_handle = pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");

if ($db_handle) {

echo 'Connection attempt succeeded.';

} else {

   

echo 'Connection attempt failed.';

}