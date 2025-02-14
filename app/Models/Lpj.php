<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lpj extends Model
{
    use HasFactory;
    protected $table = 'lpj';
    protected $guarded = ['id'];

    /**
     * Get the kegiatan that owns the Lpj
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kegiatan(): BelongsTo
    {
        return $this->belongsTo(ProgramKerja::class, 'kegiatan_id');
    }
}
