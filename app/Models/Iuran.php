<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Iuran extends Model
{
    use HasFactory;
    protected $table = 'iuran';
    protected $guarded = ['id'];

    /**
     * Get all of the detailIuran for the Iuran
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailIuran(): HasMany
    {
        return $this->hasMany(DetailIuran::class);
    }
}
