<?php
namespace App\UseCase;
use App\Models\Artisan;


class ArtisanUseCase
{
    public static function getArtisansAll(){
        return Artisan::orderBy('created_at', 'desc')->get();
    }
}
