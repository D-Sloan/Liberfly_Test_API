<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Product",
 *     title="Product",
 *     description="Product schema",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         format="int64",
 *         description="ID of the product"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Name of the product"
 *     ),
 *     @OA\Property(
 *         property="description",
 *         type="string",
 *         description="Description of the product"
 *     ),
 *     @OA\Property(
 *         property="price",
 *         type="number",
 *         format="float",
 *         description="Price of the product"
 *     ),
 *     @OA\Property(
 *         property="stock",
 *         type="integer",
 *         description="Stock of the product"
 *     ),
 * )
 */

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'price',
        'stock',
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
