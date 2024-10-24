<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['text', 'expected_answer', 'topic_id'];

    public function topic(){
        return $this->belongsTo(Topic::class);
    }
}
