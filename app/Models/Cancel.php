<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cancel extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'cancel';

    public $timestamps = false;
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = now()->toDateString(); // Menggunakan tanggal saat ini tanpa jam
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function onhold()
    {
        return $this->belongsTo(User::class, 'district');
    }
}
