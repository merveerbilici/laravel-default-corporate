<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use SoftDeletes, Sluggable;

    protected $table = 'products';

    protected $fillable = ['category_id', 'title', 'description', 'content', 'slug', 'order', 'image', 'is_active', 'created_by', 'deleted_by', 'seo_title', 'seo_description', 'show_index', 'show_header', 'show_footer'];

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

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function scopeActive($query)
    {
        $query->where('is_active', 1);
    }
    public function scopePassive($query)
    {
        $query->where('is_active', 0);
    }
    public function scopeShowIndex($query)
    {
        $query->where('show_index', 1);
    }
    public function scopeShowHeader($query)
    {
        $query->where('show_header', 1);
    }
    public function scopeShowFooter($query)
    {
        $query->where('show_footer', 1);
    }

    public function category()
    {
        return $this->hasOne('App\Models\ProductCategory', 'id', 'category_id');
    }
}
