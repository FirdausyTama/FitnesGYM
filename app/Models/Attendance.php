<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['user_id', 'check_out_at'];

    protected $casts = [
        'check_out_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDurationAttribute()
    {
        if (!$this->check_out_at) return null;
        
        $diffInSeconds = $this->created_at->diffInSeconds($this->check_out_at);
        $hours = floor($diffInSeconds / 3600);
        $minutes = floor(($diffInSeconds % 3600) / 60);
        
        if ($hours > 0) {
            return $hours . ' jam ' . $minutes . ' menit';
        }
        return $minutes . ' mnt';
    }
}
