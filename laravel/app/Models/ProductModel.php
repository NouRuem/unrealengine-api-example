<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "products";

    protected $fillable = ["unique_id", "name", "description", "image_url"];
}
