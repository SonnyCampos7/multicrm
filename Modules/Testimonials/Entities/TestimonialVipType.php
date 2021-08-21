<?php

namespace Modules\Testimonials\Entities;

use Torzer\Awesome\Landlord\BelongsToTenants;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Platform\Core\Entities\CachableModel;

/**
 * Modules\Testimonials\Entities\TestimonialVipType
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|CachableModel disableCache()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|TestimonialVipType newModelQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|TestimonialVipType newQuery()
 * @method static \Illuminate\Database\Query\Builder|TestimonialVipType onlyTrashed()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|TestimonialVipType query()
 * @method static \Illuminate\Database\Eloquent\Builder|TestimonialVipType whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestimonialVipType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestimonialVipType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestimonialVipType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestimonialVipType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestimonialVipType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CachableModel withCacheCooldownSeconds($seconds)
 * @method static \Illuminate\Database\Query\Builder|TestimonialVipType withTrashed()
 * @method static \Illuminate\Database\Query\Builder|TestimonialVipType withoutTrashed()
 * @mixin \Eloquent
 */
class TestimonialVipType extends CachableModel
{
    use SoftDeletes, BelongsToTenants;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];
    public $table = 'testimonials_dict_vip';

    public $fillable = [
        'name',
        'company_id'
    ];

    protected $dates = [
        'updated_at',
        'created_at'
    ];
}
