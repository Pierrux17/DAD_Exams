<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $table = 'topics';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['name'];

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'companies_topics');
    }
}
