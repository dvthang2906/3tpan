<?php

namespace App\Http\Livewire;

use App\Models\test;
use Livewire\Component;

class Counter extends Component
{
    public $count = 0;
    public $test_mondai;
    public $category = 'grammar'; // Giá trị mặc định


    public function mount()
    {
        $this->loadData();
    }

    public function updateCategory($newCategory)
    {
        $this->category = $newCategory;
        $this->loadData();
    }


    private function loadData()
    {
        $test = new test();
        $this->test_mondai = $test->test_mondai($this->category);
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
