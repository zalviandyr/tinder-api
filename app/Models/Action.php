<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasUuids;

    protected $table = 'actions';

    protected $fillable = [
        'person_id',
        'user_id',
        'status'
    ];
}
