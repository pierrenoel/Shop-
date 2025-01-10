<?php 

namespace app\controllers;

use app\core\Controller;
use app\models\Post;
use app\models\User;
use app\core\Request;

class HomeController extends Controller
{
    public function index(Post $post)
    {
        $posts = $post->all();
        return $this->view("home",["posts" => $posts]);
    }

    public function show(Post $post)
    {
        return $this->view("posts/show");
    }

    public function create()
    {
        return $this->view("posts/create");
    }

    public function store(Post $post, Request $request)
    {
        
        // A retravailler car ici ce n'est pas correct la façon dont on crée un article
        $post->add([
            "title" => $request->get()["title"],
            "content" =>  $request->get()["content"]
        ]);
      
    }
}