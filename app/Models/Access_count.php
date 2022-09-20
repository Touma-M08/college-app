<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Access_count extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = ['post_id', 'count'];
    
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
