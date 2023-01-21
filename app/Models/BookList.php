<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookList extends Model
{
    use HasFactory;

    protected $table = "booklists";

    protected $fillable = ['name', 'user_id'];
}
