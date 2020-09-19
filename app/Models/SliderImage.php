<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class SliderImage extends Model
{
    use SoftDeletes;

    protected $table = 'slider_images';

    protected $fillable = ['title', 'description', 'order', 'image', 'is_active', 'created_by', 'deleted_by'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model)
        {
            $user = Auth::user();
            if ($user) {
                $model->created_by = $user->id;
            }
        });
        static::deleting(function ($model)
        {
            $user = Auth::user();
            if ($user) {
                $model->deleted_by = $user->id;
                $model->save();
            }
        });
    }

    public function scopeActive($query)
    {
        $query->where('is_active', 1);
    }
    public function scopePassive($query)
    {
        $query->where('is_active', 0);
    }

}
