<?php


namespace RandomState\Canary\Laravel;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use RandomState\Canary\Laravel\Traits\Cageable as CageableTrait;

/*
 * Represents a test group of users or other groups and can be tied to a feature directly
 */

class Cage extends Model
{
    use CageableTrait;

    protected $guarded = [];
    protected $with = [];

    public function add(...$occupants)
    {
        $occupants = collect($occupants)->map(function ($item) {
            $cageable = new Cageable();
            $cageable->cage()->associate($this);
            $cageable->item()->associate($item);

            return $cageable;
        });
        
        $this->occupants()->saveMany($occupants);

        return $this;
    }

    public function occupants()
    {
        return $this->hasMany(Cageable::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }

    public function enable($feature)
    {
        $this->features()->attach($feature);

        return $this;
    }

    public function disable($feature)
    {
        $this->features()->detach($feature);

        return $this;
    }
}
