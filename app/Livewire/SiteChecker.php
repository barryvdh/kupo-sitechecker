<?php

namespace App\Livewire;

use App\Services\Checker;
use Livewire\Attributes\Url;
use Livewire\Component;

class SiteChecker extends Component
{
    #[Url]
    public $url;

    public $result;


    public function checkSite(Checker $checker)
    {
        $validated = $this->validate([
            'url' => 'required|url',
        ]);

        $this->result = $checker->check($validated['url']);
    }

    public function render()
    {
        return view('livewire.site-checker');
    }
}
