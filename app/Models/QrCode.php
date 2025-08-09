<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    use HasFactory;
    protected $fillable = ['reference_type', 'reference_id', 'code_value', 'expires_at'];
    protected $dates = ['expires_at'];
    public function isExpired()
    {
        return $this->expires_at && $this->expires_at->isPast();
    }
}
