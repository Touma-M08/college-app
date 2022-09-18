<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id','title','problem', 'solution']; 
    
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    
    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
