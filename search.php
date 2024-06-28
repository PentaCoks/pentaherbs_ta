<?php
require "koneksi.php"; // Ensure this file correctly connects to your database

if (isset($_GET['keyword'])) {
    $keyword = mysqli_real_escape_string($db, $_GET['keyword']);
    
    // Query for news table
    $queryNews = mysqli_query($db, "SELECT 'news' AS source, judul, 'news-detail.php?judul=' AS url FROM news WHERE judul LIKE '%$keyword%'");
    
    // Query for produk table
    $queryProduk = mysqli_query($db, "SELECT 'produk' AS source, nama AS judul, 'produk-detail.php?nama=' AS url FROM produk WHERE nama LIKE '%$keyword%'");
    
    $results = [];
    
    // Fetch results from news table
    while ($row = mysqli_fetch_assoc($queryNews)) {
        $results[] = [
            'source' => $row['source'],
            'title' => $row['judul'],
            'url' => $row['url'] . urlencode($row['judul']) // Adjust URL as per your requirement
        ];
    }
    
    // Fetch results from produk table
    while ($row = mysqli_fetch_assoc($queryProduk)) {
        $results[] = [
            'source' => $row['source'],
            'title' => $row['judul'],
            'url' => $row['url'] . urlencode($row['judul']) // Adjust URL as per your requirement
        ];
    }
    
    header('Content-Type: application/json');
    echo json_encode($results);
}
?>
