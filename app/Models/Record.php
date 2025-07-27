<?php

namespace App\Models;

use App\Enums\RecordStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'status'];

    protected $casts = [
        'status' => RecordStatus::class,
    ];


    public function scopeAllowed($query)
    {
        return $query->where('status', RecordStatus::Allowed);
    }
}
