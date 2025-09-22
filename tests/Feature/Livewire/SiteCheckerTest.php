<?php

use App\Livewire\SiteChecker;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(SiteChecker::class)
        ->assertStatus(200);
});
