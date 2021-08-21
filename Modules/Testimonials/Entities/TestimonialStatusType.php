<?php

namespace Modules\Testimonials\Entities;

use Torzer\Awesome\Landlord\BelongsToTenants;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Platform\Core\Entities\CachableModel;


/**
 * Modules\Testimonials\Entities\TestimonialStatusType
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|CachableModel disableCache()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|TestimonialStatusType newModelQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|TestimonialStatusType newQuery()
 * @method static \Illuminate\Database\Query\Builder|TestimonialStatusType onlyTrashed()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|TestimonialStatusType query()
 * @method static \Illuminate\Database\Eloquent\Builder|TestimonialStatusType whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestimonialStatusType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestimonialStatusType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestimonialStatusType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestimonialStatusType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestimonialStatusType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CachableModel withCacheCooldownSeconds($seconds)
 * @method static \Illuminate\Database\Query\Builder|TestimonialStatusType withTrashed()
 * @method static \Illuminate\Database\Query\Builder|TestimonialStatusType withoutTrashed()
 * @mixin \Eloquent
 */
class TestimonialStatusType extends CachableModel
{
    use SoftDeletes, BelongsToTenants;

    public $table = 'testimonials_dict_status';

    public $fillable = [
        'name',
        'company_id'
    ];

    protected $dates = [
        'updated_at',
        'created_at'
    ];
}
