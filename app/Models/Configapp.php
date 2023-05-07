<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configapp extends Model
{
    use HasFactory;
    protected $table = 'configapp';
    protected $guarded = ['id'];
}
