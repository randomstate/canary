<?php


namespace RandomState\Canary\Laravel;


use Illuminate\Database\Eloquent\Model;

/*
 * The entity that will have the enabled feature against it in the database
 */

class Cageable extends Model
{
    protected $with = ['item'];

    public function cage()
    {
        return $this->belongsTo(Cage::class);
    }

    public function item()
    {
        return $this->morphTo();
    }
}
