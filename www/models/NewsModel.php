<?php

namespace Model;

use PDO;

class NewsModel
{
    protected static $link;

    public static function link()
    {
        if (is_null(self::$link)) {
            self::$link = new PDO(
                'mysql:host=localhost;dbname=test',
                'root',
                'root',
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
            );
        }
        return self::$link;
    }

    public function getCount()
    {
        $sql = "SELECT COUNT(*) as count FROM news";
        $sth = self::link()->prepare($sql);
        $sth->execute();
        $array = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $array[0]['count'];
    }

    public function getRows($start, $limit)
    {
        $sql = "SELECT * FROM news ORDER BY idate DESC LIMIT ?, ?";
        $sth = self::link()->prepare($sql);
        $sth->bindValue(1, $start, PDO::PARAM_INT);
        $sth->bindValue(2, $limit, PDO::PARAM_INT);
        $sth->execute();
        $data = [];
        while ($row = $sth->fetchAll(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data[0];
    }

    public static function getItem($id)
    {
        $sql = "SELECT * FROM news WHERE id = :id";
        $sth = self::link()->prepare($sql);
        $sth->execute(['id' => $id]);
        $value = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $value[0];
    }
}

