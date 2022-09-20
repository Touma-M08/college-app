<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = ['user_id','title','problem', 'solution']; 
    
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function access_count()
    {
        return $this->hasOne(Access_count::class);
    }
}
