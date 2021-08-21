<?php

namespace Modules\ContactWebsites\Entities;

use Modules\Platform\Core\Entities\CachableModel;


/**
 * Modules\ContactWebsites\Entities\WebsiteTypes
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CachableModel disableCache()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|WebsiteTypes newModelQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|WebsiteTypes newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|WebsiteTypes query()
 * @method static \Illuminate\Database\Eloquent\Builder|WebsiteTypes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebsiteTypes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebsiteTypes whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebsiteTypes whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CachableModel withCacheCooldownSeconds($seconds)
 * @mixin \Eloquent
 */
class WebsiteTypes  extends CachableModel
{

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];
    public $table = 'bap_website_dict_types';

    public $fillable = [
        'names',
    ];


    protected $dates = [];
}
