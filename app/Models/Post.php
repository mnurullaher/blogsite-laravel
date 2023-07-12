<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Artisanry\Commentable\Traits\HasComments;

class Post extends Model
{
    use \Conner\Likeable\Likeable;
    use HasFactory;
    use HasComments;

    protected $fillable = ['title', 'body', 'user_id'];

    public function scopeFilter($query, array $filters) {
        if($filters['user'] ?? false) {
            $query->where('user_id', request('user'));
        }
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
