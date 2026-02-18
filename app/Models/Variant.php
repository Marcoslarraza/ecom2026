<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Variant extends Model
{
    protected $fillable = [
        'name',
        'type',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function options(): HasMany
    {
        return $this->hasMany(VariantOption::class);
    }

    public function activeOptions(): HasMany
    {
        return $this->hasMany(VariantOption::class)->where('is_active', true)->orderBy('order');
    }
}
