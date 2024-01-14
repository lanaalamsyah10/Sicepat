<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Saran extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'saran';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function saran()
    {
        return $this->belongsTo(User::class, 'district');
    }
}
