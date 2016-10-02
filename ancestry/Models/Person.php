<?php declare(strict_types=1);

namespace Ancestry\Models;

use Ancestry\Models\Types\Sex;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    public $timestamps = false;
	protected $fillable = [
		'first_name',
		'last_name',
		'location',
		'sex',
		'job',
		'illegitimate'
    ];

    public function record()
    {
        return $this->belongsTo(Record::class);
    }

    public function relations()
    {
        return $this
            ->hasMany(Relation::class, Relation::TO_PERSON_FIELD)
            ->orWhere(Relation::FROM_PERSON_FIELD, '=', $this->id);
    }

    public function marriages()
    {
        return $this->hasMany(Marriage::class, Marriage::personField($this->sex));
    }

    public function getSexAttribute($value): Sex
    {
        return new Sex($value);
    }

    public function setSexAttribute($value)
    {
        $this->attributes['sex'] = is_null($value) ? null : new Sex($value);
    }
}
