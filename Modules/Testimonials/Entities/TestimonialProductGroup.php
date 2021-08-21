<?php

namespace Modules\Testimonials\Entities;

use Torzer\Awesome\Landlord\BelongsToTenants;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Platform\Core\Entities\CachableModel;


/**
 * Modules\Testimonials\Entities\TestimonialProductGroup
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|CachableModel disableCache()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|TestimonialProductGroup newModelQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|TestimonialProductGroup newQuery()
 * @method static \Illuminate\Database\Query\Builder|TestimonialProductGroup onlyTrashed()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|TestimonialProductGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|TestimonialProductGroup whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestimonialProductGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestimonialProductGroup whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestimonialProductGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestimonialProductGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestimonialProductGroup whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CachableModel withCacheCooldownSeconds($seconds)
 * @method static \Illuminate\Database\Query\Builder|TestimonialProductGroup withTrashed()
 * @method static \Illuminate\Database\Query\Builder|TestimonialProductGroup withoutTrashed()
 * @mixin \Eloquent
 */
class TestimonialProductGroup  extends CachableModel
{
    use SoftDeletes, BelongsToTenants;

    public $table = 'products_dict_testimonialgroup';

    public $fillable = [
        'name',
        'company_id'
    ];


    protected $dates = [
        'updated_at',
        'created_at'
    ];
}
