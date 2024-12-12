<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\CreateDataBase;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


///Comando para criação do banco de dados
Artisan::command('app:create-data-base {name}',function ($name){
    $this->call(CreateDataBase::class,['name'=>$name]);
});