<?php declare(strict_types=1);

namespace Ancestry\Models;

use Carbon\Carbon;
use Ancestry\Models\Types\Sex;
use Illuminate\Database\Eloquent\Model;

class Marriage extends Model
{
    protected $dates = ['date'];
    public $timestamps = false;
    protected $fillable = [
        'date',
        'location'
    ];

    const GROOM_PERSON_ID = 'groom_person_id';
    const BRIDE_PERSON_ID = 'bride_person_id';

    public function groomPerson()
    {
        return $this->belongsTo(Person::class, self::GROOM_PERSON_ID);
    }

    public function bridePerson()
    {
        return $this->belongsTo(Person::class, self::BRIDE_PERSON_ID);
    }

    public function record()
    {
        return $this->belongsTo(Record::class);
    }

    public static function personField(Sex $sex): string
    {
        return $sex->isMale()
            ? self::GROOM_PERSON_ID
            : self::BRIDE_PERSON_ID;
    }

    public function setDateAttribute($value)
    {
        // Empty string or null will be null
        $this->attributes['date'] = empty($value) ? null : Carbon::parse($value);
    }
}
