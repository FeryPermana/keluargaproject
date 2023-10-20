<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    use HasFactory;

    protected $table = "keluarga";

    protected $fillable = ['name', 'gender', 'parent_id'];

    public $timestamps = false;

    public function parents()
    {
        return $this->hasMany(Keluarga::class, 'parent_id');
    }
}
