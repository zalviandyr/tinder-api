<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Action extends Model
{
    use HasUuids;

    protected $table = 'actions';

    protected $fillable = [
        'person_id',
        'user_id',
        'status'
    ];

    protected $with = [
        'person'
    ];

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
