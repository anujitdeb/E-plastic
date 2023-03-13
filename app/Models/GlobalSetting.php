<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class GlobalSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'site_title',
        'logo',
        'favicon',
        'site_email',
        'site_phone',
        'site_address',
        'facebook',
        'twitter',
        'instagram',
        'youtube',
        'linkedin',
        'pinterest',
    ];

    //delete the cache when the setting is updated
    public static function boot()
    {
        parent::boot();
        static::created(function ($setting) {
            Cache::forget('setting');
        });
        static::updated(function ($setting) {
            Cache::forget('setting');
        });
    }
}
