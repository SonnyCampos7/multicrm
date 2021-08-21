<?php

namespace Modules\Deals\Entities;

use Cog\Contracts\Ownership\Ownable;
use Cog\Laravel\Ownership\Traits\HasMorphOwner;
use Torzer\Awesome\Landlord\BelongsToTenants;
use Modules\Platform\Core\Entities\CachableModel;


/**
 * Modules\Deals\Entities\DealStatus
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $step_name
 * @property string|null $description
 * @property string|null $owned_by_type
 * @property int|null $owned_by_id
 * @property int|null $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $ownedBy
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $owner
 * @method static \Illuminate\Database\Eloquent\Builder|CachableModel disableCache()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|DealStatus newModelQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|DealStatus newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|DealStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|DealStatus whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DealStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DealStatus whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DealStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DealStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DealStatus whereNotOwnedBy(\Cog\Contracts\Ownership\CanBeOwner $owner)
 * @method static \Illuminate\Database\Eloquent\Builder|DealStatus whereOwnedBy(\Cog\Contracts\Ownership\CanBeOwner $owner)
 * @method static \Illuminate\Database\Eloquent\Builder|DealStatus whereOwnedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DealStatus whereOwnedByType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DealStatus whereStepName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DealStatus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CachableModel withCacheCooldownSeconds($seconds)
 * @mixin \Eloquent
 */
class DealStatus extends CachableModel implements Ownable
{
    use BelongsToTenants, HasMorphOwner;


    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];
    public $table = 'deals_dict_status';

    public $fillable = [
        'name',
        'step_name',
        'assigned_id',
        'company_id'
    ];


    protected $dates = ['deleted_at', 'created_at', 'updated_at'];
}
