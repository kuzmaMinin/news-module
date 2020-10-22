<?php
echo '<link href="index.css" rel="stylesheet" type="text/css">';

include "connection.php";

$select = mysqli_query($link, "SELECT * FROM news");

$mass = array();

while ($data = mysqli_fetch_assoc($select)) {
    $mass[$data['id']]['title'] = $data['title'];
    $mass[$data['id']]['content'] = $data['content'];
}

$id = $_GET['id'];

if ($id) {
    echo "<div class='content'>" .
        "<h2 class='title'>" . $mass[$id]['title'] . "</h2>" .
        "<hr>" .
        $mass[$id]['content'] .
        "<hr>" .
        "<a  href='news.php'>Вcе новости ></a>>" . "<br>" . "<br>" .
        "</div>";
}
?>