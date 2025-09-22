<?php

use Illuminate\Support\Facades\Route;
use App\Http\Requests\CheckRequest;
use App\Services\Checker;
use Illuminate\Http\JsonResponse;

Route::get('/', \App\Livewire\SiteChecker::class)->name('dashboard');

Route::get('check', static function (CheckRequest $request, Checker $checker): JsonResponse {
    return response()->json($checker->check($request->url));
})->name('check');

