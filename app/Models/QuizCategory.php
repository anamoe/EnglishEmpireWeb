<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizCategory extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function mainCategories()
    {
        return $this->hasMany(MainCategory::class);
    }

}
