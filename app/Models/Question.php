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

    public function exams()
    {
        return $this->hasManyThrough(
            Exam::class,
            Response::class,
            'fk_question_id', // Clé étrangère dans la table Response pour la question
            'id',             // Clé primaire dans la table Exam
            'id',             // Clé primaire dans la table Question
            'fk_exam_id'      // Clé étrangère dans la table Response pour l'examen
        );
    }

}
