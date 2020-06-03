<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\Traits\HasTranslation;

class Product extends Model
{
    use HasTranslation;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    protected $fillable = [
        'product',
        'cost',
        'iso_code',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'is_active' => 0,
    ];

    protected $translatable = [
        'product'
    ];


    public function getAllProducts()
    {
        return $this->paginate(16);
    }

    public function presentPrice()
    {
        return '$ ' . number_format($this->cost, 0);
    }
}
