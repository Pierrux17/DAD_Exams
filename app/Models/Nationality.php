<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    use HasFactory;

    protected $table = 'nationalities';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['name', 'code'];
}
