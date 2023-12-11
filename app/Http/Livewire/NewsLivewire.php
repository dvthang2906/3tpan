<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\news\news;

class NewsLivewire extends Component
{

    public $newsID = 1;
    public $data;
    public $content;

    public function mount()
    {
        $this->getNews();
    }

    public function updateNewID($newID)
    {
        $this->newsID = $newID;
        $this->getNews();
    }

    public function getNews()
    {
        $getData = new news();
        $this->data = $getData->getDataNews();

        $this->content = $getData->getNewContent($this->newsID);
    }

    public function render()
    {
        return view('livewire.news-livewire');
    }
}
