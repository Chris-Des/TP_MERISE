<?php

namespace App\src\Entity;

use App\src\Entity\Database;
use PDO;

class Comment extends Database
{
    public $id;
    public $content;
    public $createdAt;
    public $state;
    public $user_id;
    public $article_id;

    public function __construct()
    {
        parent::__construct();
    }

    public function setContent($content)
    {
        $this->content = $content;
        return $this->content;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setState($state)
    {
        $this->state = $state;
        return $this->state;
    }

    public function getCommentList()
    {
        $query = 'SELECT * FROM `comment`';
        $queryResult = $this->db->query($query);
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }

    public function addComment()
    {
        $insert = 'INSERT INTO `comment` (`content`, `state`, `id_user`, `id_article`) 
               SELECT :content, :state, `user`.`id`, `article`.`id`
               FROM `user`
               INNER JOIN `article` ON `article`.`id` = :article_id
               WHERE `user`.`id` = :user_id;';

        $insertDb = $this->db->prepare($insert);
        $insertDb->bindValue(':content', $this->content, PDO::PARAM_STR);
        $insertDb->bindValue(':state', $this->state, PDO::PARAM_STR);
        $insertDb->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);
        $insertDb->bindValue(':article_id', $this->article_id, PDO::PARAM_INT);

        return $insertDb->execute();
    }
    public function getComment()
    {
        $query = 'SELECT * FROM `comment` WHERE `state` = 1';
        $queryResult = $this->db->query($query);
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }

public function getCommentsByArticleId($articleId)
{
    $query = 'SELECT * FROM `comment` WHERE `id_article` = :article_id';
    $queryResult = $this->db->prepare($query);
    $queryResult->bindValue(':article_id', $articleId, PDO::PARAM_INT);
    $queryResult->execute();
    return $queryResult->fetchAll(PDO::FETCH_OBJ);
}

    public function deleteComment()
    {
        $delete = 'DELETE FROM `comment` WHERE `id` = :id';
        $deleteDb = $this->db->prepare($delete);
        $deleteDb->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $deleteDb->execute();
    }
}
