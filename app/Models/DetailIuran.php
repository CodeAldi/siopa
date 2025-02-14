<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailIuran extends Model
{
    use HasFactory;
    protected $table = 'detail_iuran';
    protected $guarded = ['id'];

    /**
     * Get the iuran that owns the DetailIuran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function iuran(): BelongsTo
    {
        return $this->belongsTo(Iuran::class, 'iuran_id');
    }
    /**
     * Get the anggota that owns the DetailIuran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function anggota(): BelongsTo
    {
        return $this->belongsTo(User::class, 'anggota_id');
    }
}
