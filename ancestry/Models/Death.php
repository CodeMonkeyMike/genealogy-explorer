<?php declare(strict_types=1);

namespace Ancestry\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Death extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'before',
        'date',
        'location'
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function record()
    {
        return $this->belongsTo(Record::class);
    }

    public function setDateAttribute($value)
    {
        // Empty string or null will be null
        $this->attributes['date'] = empty($value) ? null : Carbon::parse($value);
    }
}
