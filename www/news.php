<?php

include "connection.php";

mysqli_query($link, "SET NAMES 'utf-8'");

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

function addCards($data)
{
    for ($i = 0; $i < count($data); $i++) {
        $id = $data[$i]['id'];
        $idate = "<span class='data'>" . date("d.m.Y", $data[$i]['idate']) . "</span>";
        $title = "<a href='view.php?id=$id'>" . $data[$i]['title'] . "</a>" . "<br>";
        $announce = $data[$i]['announce'];
        echo "<div class='card'>" . $idate . $title . $announce . "</div>";
    }
}

function addPagination($page, $pagesCount) {
    for ($i = 1; $i <= $pagesCount; $i++) {
        if ($page == $i) {
            $class = ' class="pagination-item active"';
        } else {
            $class = ' class="pagination-item"';
        }
        echo "<a $class href='?page=$i'>$i</a>";
    }
}

$notesOnPage = 5;
$from = ($page - 1) * $notesOnPage;

$query = "SELECT * FROM news ORDER BY idate DESC LIMIT $from, $notesOnPage ";
$result = mysqli_query($link, $query) or die (mysqli_error($link));

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

$query = "SELECT COUNT(*) as count FROM news";
$result = mysqli_query($link, $query) or die (mysqli_error($link));
$count = mysqli_fetch_assoc($result)['count'];
$pagesCount = ceil($count / $notesOnPage);

mysqli_close($link);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Новости</title>
    <link rel="stylesheet" href="/index.css">
</head>
<body>

<div class="container">
    <h2>Новости</h2>
    <hr>
    <?php addCards($data); ?>
    <hr>
    <h4>Страницы:</h4>
    <div class="pagination-container">
        <?php addPagination($page, $pagesCount); ?>
    </div>
</div>
</body>
</html>
