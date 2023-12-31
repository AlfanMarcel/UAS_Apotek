<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $fillable = [
        'kode_barang',
        'user_id',
        'category_id',
        'supplier_id',
        'nama',
        'harga',
        'description',
        'stok',
        'image',
        'telfon',
        'diskon'
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }


    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function OrderDetail()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
