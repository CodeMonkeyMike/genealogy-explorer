<?php declare(strict_types=1);

namespace Ancestry\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $dates = ['date_recorded'];
    public $timestamps = false;
    protected $fillable = [
        'outside_id',
        'date_recorded',
        'recording_location'
    ];

    public function people()
    {
        return $this->hasMany(Person::class);
    }

    public function relations()
    {
        return $this->hasMany(Relation::class);
    }

    public function setDateRecordedAttribute($value)
    {
        $this->attributes['date_recorded'] = empty($value) ? null : Carbon::parse($value);
    }
}
