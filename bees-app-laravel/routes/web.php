<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KomentarDownload;

Route::get('/comm', [KomentarDownload::class, 'pogled']);

Route::get('/komentari/{id}/preuzmi', [KomentarDownload::class, 'generateKomentarDoc']);




