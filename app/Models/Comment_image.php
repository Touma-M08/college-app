<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment_image extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = ['comment_id', 'image'];
    
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
