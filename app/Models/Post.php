<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = ['name','title','problem', 'solution']; 
    
    public function Images()
    {
        return $this->hasMany(Image::class);
    }
}
