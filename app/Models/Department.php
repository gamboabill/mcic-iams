<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Department extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $guarded = [];

    protected $fillable = [
        'name',
        'code',
        'description',
    ];
}
