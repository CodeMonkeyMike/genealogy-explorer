<?php declare(strict_types=1);

namespace Ancestry\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $dates = ['date'];
    public $timestamps = false;
    protected $fillable = [
        'date',
        'place_name',
        'country_name',
    ];

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

