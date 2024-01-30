<?php

namespace App\Http\Livewire;

use App\Models\test;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class TestLivewire extends Component
{
    public $count = 0;
    public $test_mondai;
    public $test_question;
    public $test_answer;
    public $category = 'vocabulary'; // Giá trị mặc định
    public $level = 'N4';


    public function mount()
    {
        $this->loadData();
    }

    public function updateCategory($newCategory, $newLevel)
    {
        $this->category = $newCategory;
        $this->level = $newLevel;
        session()->put('category', $newCategory);
        $this->loadData();
    }


    private function loadData()
    {
        $test = new test();

        $this->test_mondai = $test->test_mondai($this->category, $this->level);
        // dd($this->test_mondai[0]->CATEGORY);

        $this->test_question = $test->test_question($this->level);
        // dd($this->test_question);
        $this->test_answer = $test->test_answer($this->level);
        // dd($this->test_answer);

    }

    public function render()
    {
        return view('livewire.test-livewire');
    }
}
