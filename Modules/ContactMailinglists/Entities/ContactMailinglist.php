<?php

namespace Modules\ContactMailinglists\Entities;

use Bnb\Laravel\Attachments\HasAttachment;
use Torzer\Awesome\Landlord\BelongsToTenants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Modules\Contacts\Entities\Contact;
use Modules\Platform\Core\Traits\Commentable;

/**
 * Modules\ContactMailinglists\Entities\ContactMailinglist
 *
 * @property int $id
 * @property int $contact_id
 * @property int|null $subscribe_email_id
 * @property int $mailinglist_id
 * @property string|null $subscribe_ip
 * @property string|null $subscribe_origin_page
 * @property string|null $subscribe_origin_id
 * @property string|null $subscribe_date
 * @property string|null $unsubscribe_date
 * @property int $company_id
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Bnb\Laravel\Attachments\Attachment[] $attachments
 * @property-read int|null $attachments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Platform\Core\Entities\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read Contact $contact
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMailinglist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMailinglist newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMailinglist query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMailinglist whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMailinglist whereContactId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMailinglist whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMailinglist whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMailinglist whereMailinglistId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMailinglist whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMailinglist whereSubscribeDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMailinglist whereSubscribeEmailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMailinglist whereSubscribeIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMailinglist whereSubscribeOriginId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMailinglist whereSubscribeOriginPage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMailinglist whereUnsubscribeDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMailinglist whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ContactMailinglist extends Model
{

    use BelongsToTenants, Commentable, HasAttachment;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];
    public $table = 'contact_mailinglist';
    public $fillable = [
        'url',
        'type_id',
        'is_default',
        'is_active',
        'contact_id',
        'notes',
    ];
    protected $mustBeApproved = false;

    protected $dates = ['created_at', 'updated_at'];

    public static function boot()
    {
        parent::boot();
    }


    /**
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }


}
