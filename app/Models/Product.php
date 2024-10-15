<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // mass assignable columns
    protected $fillable = ['name', 'brand', 'category_id', 'price', 'weight', 'desc'];

    // inverse relationship to Category model 
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    // relationship to User model 
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // //Mutator                     
    // protected function price(): Attribute // eloquent\casts
    // {
    //     return Attribute::make(
    //         set: fn(int $value) => $value * 100,
    //         get: fn(int $value) => $value / 100
    //     );
    // }
}
