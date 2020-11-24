<?php


namespace RandomState\Canary\Laravel;


use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;

/*
 * Represents a feature toggle in the database
 */

class Feature extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    public static function named($name)
    {
        $feature = new static;
        $feature->id = $name;

        return $feature;
    }
    
    public static function enabled($name) 
    {
        return static::where('id', $name)
            ->where('enabled', true)
            ->exists();    
    }
    
    public function scopeAvailable(Builder $query)
    {
        return $query->where('available', true);
    }
    
    public function enable() 
    {
        $this->enabled = true;
        
        return $this;
    }
    
    public function disable()
    {
        $this->enabled = false;
        
        return $this;
    }
}
