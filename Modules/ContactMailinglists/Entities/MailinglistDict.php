<?php

namespace Modules\ContactMailinglists\Entities;

use Torzer\Awesome\Landlord\BelongsToTenants;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Platform\Core\Entities\CachableModel;


/**
 * Modules\ContactMailinglists\Entities\MailinglistDict
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int|null $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|CachableModel disableCache()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|MailinglistDict newModelQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|MailinglistDict newQuery()
 * @method static \Illuminate\Database\Query\Builder|MailinglistDict onlyTrashed()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|MailinglistDict query()
 * @method static \Illuminate\Database\Eloquent\Builder|MailinglistDict whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailinglistDict whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailinglistDict whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailinglistDict whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailinglistDict whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailinglistDict whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailinglistDict whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CachableModel withCacheCooldownSeconds($seconds)
 * @method static \Illuminate\Database\Query\Builder|MailinglistDict withTrashed()
 * @method static \Illuminate\Database\Query\Builder|MailinglistDict withoutTrashed()
 * @mixin \Eloquent
 */
class MailinglistDict extends CachableModel
{

    use SoftDeletes, BelongsToTenants;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];
    public $table = 'mailinglist_dict';

    public $fillable = [
        'name',
        'company_id'
    ];

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];
}
