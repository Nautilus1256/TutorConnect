<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'question_id',
        'comment',
    ];
    
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function scopeGetPaginateByLimit($query, int $limit_count = 2)
    {
        return $query->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}
