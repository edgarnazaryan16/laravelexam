<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = [
        'taskname',
        'created_by',
        'assigned_to',
        'status',
        'description',
    ];
    use HasFactory;

    public function created_by_user(): BelongsTo {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function assigned_to_user(): BelongsTo {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
