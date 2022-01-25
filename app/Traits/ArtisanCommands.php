<?php


namespace App\Traits;


trait ArtisanCommands
{

    public  function runQueue(){
        \Artisan::call('queue:work');
    }

}
