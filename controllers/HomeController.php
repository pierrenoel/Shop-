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

    public function create()
    {
        return $this->view("post/create");
    }

    public function store(Post $post, Request $request)
    {
        $title = $request->get()["title"];
        $content = $request->get()["content"];

        $post->add([
            "title" => $title,
            "content" => $content
        ]);
      
    }
}