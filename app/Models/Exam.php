<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Exam extends Model
{
    use HasFactory;

    protected $table = 'exams';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['result', 'status', 'is_validated', 'exam_date', 'place', 'user_id', 'topic_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function topic(){
        return $this->belongsTo(Topic::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'exam_question');
    }


    public static function status()
    {
        return [
            'En attente',
            'En cours',
            'Réussi',
            'Raté',
        ];
    }

    public function generateToken()
    {
        $this->token = Str::random(60);
        $this->token_expires_at = now()->addDays(20); 
        $this->save();

        Log::info("Token généré pour l'examen ID {$this->id} : {$this->token}");
    }
}
