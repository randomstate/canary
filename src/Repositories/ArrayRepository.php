<?php


namespace RandomState\Canary\Repositories;


class ArrayRepository
{
    /**
     * @var array
     */
    protected $globals = [];

    public function enabled($feature, $featurable = null)
    {
        if($featurable) {
            return isset($this->scoped[$feature][$featurable->getId()]);
        }

        return isset($this->globals[$feature]);
    }

    public function enable($feature, $featurable = null)
    {
        if($featurable) {
            if(!isset($this->scoped[$feature])) {
                $this->scoped[$feature] = [];
            }

            $this->scoped[$feature][$featurable->getId()] = true;
        } else {
            $this->globals[$feature] = true;
        }

        return $this;
    }

    public function disable($feature, $featurable = null)
    {
        if($featurable) {
            unset ($this->scoped[$feature][$featurable->getId()]);
        } else {
            unset($this->globals[$feature]);
        }

        return $this;
    }
}