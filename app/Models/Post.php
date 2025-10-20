<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Category;


class Post extends Model
{
    use HasFactory;
      protected $with = ['author', 'category']; //eager loading biar ga nambah query di view
     protected $fillable = ['title', 'slug', 'author', 'body']; //bisa diisi dari network /tinker

     public function author():BelongsTo
     {
        return $this->belongsTo(User::class);
     }

     public function category():BelongsTo
     {
        return $this->belongsTo(Category::class);
     }
    // protected $quarded = ['id']; *tidak bisa diisi dri networkk (dijaga)
}
