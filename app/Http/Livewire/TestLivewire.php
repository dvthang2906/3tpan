<?php

namespace App\Http\Livewire;

use App\Models\test;
use Livewire\Component;

class TestLivewire extends Component
{
    public $count = 0;
    public $test_mondai;
    public $test_question;
    public $test_answer;
    public $category = 'vocabulary'; // Giá trị mặc định


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
        // dd($this->test_mondai);

        $this->test_question = $test->test_question();
        // dd($this->test_question);
        $this->test_answer = $test->test_answer();
        // dd($this->test_answer);
    }

    public function render()
    {
        return view('livewire.test-livewire');
    }
}
