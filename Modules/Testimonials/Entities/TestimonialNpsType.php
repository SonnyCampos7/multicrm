<?php

namespace Modules\Testimonials\Entities;

use Torzer\Awesome\Landlord\BelongsToTenants;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Platform\Core\Entities\CachableModel;


/**
 * Modules\Testimonials\Entities\TestimonialNpsType
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|CachableModel disableCache()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|TestimonialNpsType newModelQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|TestimonialNpsType newQuery()
 * @method static \Illuminate\Database\Query\Builder|TestimonialNpsType onlyTrashed()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|TestimonialNpsType query()
 * @method static \Illuminate\Database\Eloquent\Builder|TestimonialNpsType whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestimonialNpsType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestimonialNpsType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestimonialNpsType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestimonialNpsType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestimonialNpsType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CachableModel withCacheCooldownSeconds($seconds)
 * @method static \Illuminate\Database\Query\Builder|TestimonialNpsType withTrashed()
 * @method static \Illuminate\Database\Query\Builder|TestimonialNpsType withoutTrashed()
 * @mixin \Eloquent
 */
class TestimonialNpsType  extends CachableModel
{
    use SoftDeletes, BelongsToTenants;

    public $table = 'testimonials_dict_nps';

    public $fillable = [
        'name',
        'company_id'
    ];


    protected $dates = [
        'updated_at',
        'created_at'
    ];
}
