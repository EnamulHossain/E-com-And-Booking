<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//  use Nicolaslopezj\Searchable\SearchableTrait;
// use Laravel\Scout\Searchable;
use App\Models\ProductCategory;
use App\Models\Tag;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Product extends Model implements HasMedia {
    use HasMediaTrait {
        getFirstMediaUrl as protected getFirstMediaUrlTrait;
    }
    // use InteractsWithMedia;
    // protected $table = 'products';

    public $fillable = [
        'name', 'slug', 'details', 'price', 'quantity', 'description', 'featured', 'category_id', 'offer_price', 'offer_start', 'offer_end','colors',
    ];

    public $withJoin = [
        'productcategory',
        'tag',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productcategory()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
    public function tag()
    {
        return $this->belongsToMany('App\Models\Tag', 'product_tag', 'product_id', 'tag_id');
    }

    /**
     * Add Media to api results
     * @return bool
     */
    public function getHasMediaAttribute(): bool
    {
        return $this->hasMedia('image');
    }
    
    public function getFirstMediaUrl($collectionName = 'default', string $conversion = '')
    {
        $url = $this->getFirstMediaUrlTrait($collectionName);
        $array = explode('.', $url);
        $extension = strtolower(end($array));
        if (in_array($extension, config('medialibrary.extensions_has_thumb'))) {
            return asset($this->getFirstMediaUrlTrait($collectionName, $conversion));
        } else {
            return asset(config('medialibrary.icons_folder') . '/' . $extension . '.png');
        }
    }
}
