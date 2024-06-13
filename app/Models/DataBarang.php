<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBarang extends Model
{
    use HasFactory;

    protected $primaryKey = 'databarangs_id';

    protected $fillable = [
        'nama_barang',
        'volume',
        'satuan',
        'harga_satuan',
        'jumlah',
    ];

    public function distribusi_barang()
    {
        return $this->hasMany(DistribusiBarang::class);
    }
    
}
