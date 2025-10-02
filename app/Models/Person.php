<?php

namespace App\Models;

use App\Models\Action;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function actions(): HasMany
    {
        return $this->hasMany(Action::class);
    }
}
