<?php


namespace RandomState\Canary;


use RandomState\Canary\Repositories\ArrayRepository;

class FeatureManager
{
    /**
     * @var FeatureRepository
     */
    protected $repository;

    public function __construct(FeatureRepository $repository = null)
    {
        if(!$repository) {
            $repository = new ArrayRepository;
        }

        $this->repository = $repository;
    }

    public function enabled($feature, $featurable = null)
    {
        return $this->repository->enabled($feature, $featurable);
    }

    public function enable($feature, $featurable = null)
    {
        $this->repository->enable($feature, $featurable);

        return $this;
    }

    public function disable($feature, $featurable = null)
    {
        $this->repository->disable($feature, $featurable);

        return $this;
    }
}