<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\RowsCreated;

class Row extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'date'];
    public $timestamps = false;

    protected $dispatchesEvents = [
        'created' => RowsCreated::class,
    ];
}
