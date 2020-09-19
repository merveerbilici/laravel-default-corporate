<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Cviebrock\EloquentSluggable\Sluggable;

class ProductCategory extends Model
{
    use SoftDeletes, Sluggable;

    protected $table = 'product_categories';

    protected $fillable = ['name', 'description', 'slug', 'order', 'image', 'is_active', 'created_by', 'deleted_by', 'seo_title', 'seo_description', 'show_index', 'show_header', 'show_footer'];

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
                'source' => 'name'
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

    public function products()
    {
        return $this->hasMany('App\Models\Product', 'category_id', 'id');
    }
}
