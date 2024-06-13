<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistribusiBarang extends Model
{
    use HasFactory;

    protected $fillable = [
        'distribusis_id',
        'databarangs_id',
    ];

    public function distribusi()
    {
        return $this->belongsTo(Distribusi::class, 'distribusis_id');
    }

    public function databarang()
    {
        return $this->belongsTo(DataBarang::class, 'databarangs_id');
    }
}
