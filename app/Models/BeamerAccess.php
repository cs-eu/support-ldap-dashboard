<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeamerAccess extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'accessed_at',
    ];
}
