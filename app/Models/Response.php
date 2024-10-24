<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $table = 'responses';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['user_answer', 'is_correct', 'question_id', 'exam_id'];

    public function question(){
        return $this->belongsTo(Question::class);
    }

    public function exam(){
        return $this->belongsTo(Exam::class);
    }
}
