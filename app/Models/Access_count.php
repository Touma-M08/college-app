<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Access_count extends Model
{
    use HasFactory;
    
    protected $fillable = ['post_id', 'count'];
    
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
