<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\news\news;

class NewsLivewire extends Component
{

    public $newsID = 1;
    public $data;
    public $DataContent;
    // public $readStatuses = [];

    public function mount()
    {
        $this->getNews();
        // Example initialization, adapt it to your actual data source
        // foreach ($this->data as $item) {
        //     $this->readStatuses[$item->id] = false; // Initialize with false or a default value
        // }
    }

    public function updateNewID($newID)
    {
        $this->newsID = $newID;
        $this->getNews();
        // // Update logic
        // $this->readStatuses[$newID] = true; // Mark as read
        // $this->emit('newsItemUpdated', $newID);
    }

    public function getNews()
    {
        $getData = new news();
        $this->data = $getData->getDataNews();

        $this->DataContent = $getData->getNewContent($this->newsID);
        // dd($this->DataContent);
    }

    public function render()
    {
        return view('livewire.news-livewire');
    }
}
