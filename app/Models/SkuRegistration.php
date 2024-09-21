<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkuRegistration extends Model
{
    protected $table= "sku_registrations";
    protected $primaryKey = "id";
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
