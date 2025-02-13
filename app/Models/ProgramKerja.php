<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgramKerja extends Model
{
    use HasFactory;
    protected $table = 'program_kerja';
    protected $guarded = ['id'];

    /**
     * Get the penanggungJawab that owns the ProgramKerja
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function penanggungJawab(): BelongsTo
    {
        return $this->belongsTo(User::class, 'penanggung_jawab');
    }
}
