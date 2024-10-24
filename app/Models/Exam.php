<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $table = 'exams';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['result', 'status', 'is_validated', 'user_id', 'topic_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function topic(){
        return $this->belongsTo(Topic::class);
    }
}
