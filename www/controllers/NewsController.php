<?php

namespace Controller;

use Model\NewsModel;

class NewsController
{
    public function actionList($page)
    {
        $newsModel = new NewsModel;
        $notesOnPage = 5;
        $from = ($page - 1) * $notesOnPage;
        $items = $newsModel->getRows($from, $notesOnPage);
        $pagesCount = ceil($newsModel->getCount() / $notesOnPage);
        $this->render('list', ['items' => $items, 'pagesCount' => $pagesCount, 'page' => $page]);
    }

    public function actionDetail($id)
    {
        $data = (new NewsModel)->getItem($id);
        $this->render('detail', ['id' => $id, 'data' => $data]);
    }

    public function render($template, $args)
    {
        extract($args);
        ob_start();
        include $_SERVER['DOCUMENT_ROOT'] . '/views/' . $template . '.php';
        $content = ob_get_contents();
        ob_end_clean();
        include $_SERVER['DOCUMENT_ROOT'] . '/views/layout.php';
    }
}


