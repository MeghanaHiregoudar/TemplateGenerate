<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterType extends Model
{
    use HasFactory;
    protected $table = 'letter_types';
    protected $fillable = [
        'letter_type', 'field_id' , 'body'
    ];
}
