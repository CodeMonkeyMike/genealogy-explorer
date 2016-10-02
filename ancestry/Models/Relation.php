<?php declare(strict_types=1);

namespace Ancestry\Models;

use Ancestry\Models\Types\Related;
use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'type'
    ];

    const TO_PERSON_FIELD = 'to_person_id';
    const FROM_PERSON_FIELD = 'from_person_id';

    public function toPerson()
    {
        return $this->belongsTo(Person::class, self::TO_PERSON_FIELD);
    }

    public function fromPerson()
    {
        return $this->belongsTo(Person::class, self::FROM_PERSON_FIELD);
    }

    public function record()
    {
        return $this->belongsTo(Record::class);
    }

    public function getTypeAttribute(string $value): Related
    {
        return new Related($value);
    }

    public function setTypeAttribute($value)
    {
        $this->attributes['type'] = new Related($value);
    }
}
