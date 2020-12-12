<div class="container">
    <h2>Новости</h2>
    <hr>
    <?php foreach ($items as $item) { ?>
        <div class='card'>
            <span class='data'> <?= date("d.m.Y", $item["idate"]); ?> </span>
            <a href='/news/<?= $item['id']; ?>'> <?= $item["title"]; ?> </a>
            <br>
            <p>  <?= $item['announce']; ?> </p>
        </div>
    <? }; ?>
    <hr>
    <h4>Страницы:</h4>
    <div class="pagination-container">
        <?php for ($i = 1; $i < $pagesCount; $i++) { ?>
            <a class=<?php echo ($i == $page) ? "pagination-item-active" : "pagination-item"; ?>
               href='/news/page-<?= $i; ?>'><?= $i; ?>
            </a>
        <? }; ?>
    </div>
</div>