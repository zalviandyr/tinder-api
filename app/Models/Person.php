<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'persons';

    protected $fillable = [
        'name',
        'picture',
        'location',
        'age',
        'distance',
    ];
}
