<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Kuismaster extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "kuis";
}