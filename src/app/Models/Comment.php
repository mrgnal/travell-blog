<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable=[
        'post_id',
        'user_id',
        'content',
    ];

    public function post(){

        $this->belongsTo(Post::class);
    }

    public function user(){
        $this->belongsTo(User::class);
    }
}
