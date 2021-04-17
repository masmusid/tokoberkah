<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;


class barang extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'barang';

    public function Suppliers()
    {
        return $this->belongsTo('App\Models\Supplier','supplier_id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }
}
