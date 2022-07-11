<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class Posts extends Component
{
    public $posts = [];
    public $hidePosts = false;

    public function __construct()
    {
        $this->posts = Post::all();
    }

    public function allPosts()
    {
        $this->hidePosts = false;
    }

    public function add()
    {
        $this->hidePosts = true;
    }

    public function render()
    {
        return view('livewire.posts');
    }
}
