<?php

namespace Modules\Testimonials\Entities;

use Torzer\Awesome\Landlord\BelongsToTenants;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Platform\Core\Entities\CachableModel;


/**
 * Modules\Testimonials\Entities\TestimonialUsageType
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|CachableModel disableCache()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|TestimonialUsageType newModelQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|TestimonialUsageType newQuery()
 * @method static \Illuminate\Database\Query\Builder|TestimonialUsageType onlyTrashed()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|TestimonialUsageType query()
 * @method static \Illuminate\Database\Eloquent\Builder|TestimonialUsageType whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestimonialUsageType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestimonialUsageType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestimonialUsageType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestimonialUsageType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestimonialUsageType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CachableModel withCacheCooldownSeconds($seconds)
 * @method static \Illuminate\Database\Query\Builder|TestimonialUsageType withTrashed()
 * @method static \Illuminate\Database\Query\Builder|TestimonialUsageType withoutTrashed()
 * @mixin \Eloquent
 */
class TestimonialUsageType  extends CachableModel
{
    use SoftDeletes, BelongsToTenants;

    public $table = 'testimonials_dict_usage';

    public $fillable = [
        'name',
        'company_id'
    ];

    protected $dates = [
        'updated_at',
        'created_at'
    ];
}
