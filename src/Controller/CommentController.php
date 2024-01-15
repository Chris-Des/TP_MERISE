<?php

namespace App\src\Controller;

use App\src\Entity\Comment;
use App\src\Controller\TwigController;

class CommentController extends TwigController{

    public function index()
    {
        $comment = new Comment();
        $comments = $comment->getComment();
        echo $this->twig->render("comment/index.html.twig", [
            'comments' => $comments,
            'data' => 'Bienvenue sur le controller Comment!',
            'session' => $_SESSION
        ]);
    }
}