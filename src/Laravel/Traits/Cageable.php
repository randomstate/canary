<?php

namespace RandomState\Canary\Laravel\Traits;

use RandomState\Canary\Laravel\Cage;
use Illuminate\Foundation\Auth\Access\Authorizable;

use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use RandomState\Canary\Laravel\Cageable as CageableModel;

trait Cageable
{
    use Authorizable, HasRelationships;

    public function cages()
    {
        return $this->hasManyDeep(Cage::class, ['cageables'], ['item_id'])->where('item_type', $this->getMorphClass());
    }
}
