<?php


namespace RandomState\Canary\Tests\Feature\Laravel;

use RandomState\Canary\FeatureManager;
use RandomState\Canary\Tests\TestCase;
use RandomState\Canary\Laravel\Feature;

class FeaturesTest extends TestCase
{
    protected $manager;

    protected function setUp(): void
    {
        parent::setUp();

        $this->manager = new FeatureManager;
    }

    /**
     * @test
     */
    public function can_enable_global_features()
    {
        $feature = Feature::named('image-uploads');
        $feature->save();
        
        $this->assertFalse(Feature::enabled('image-uploads'));
        $feature->enable();
        $feature->save();
        $this->assertTrue(Feature::enabled('image-uploads'));
    }

    /**
     * @test
     */
    public function can_disable_global_features()
    {
        $feature = Feature::named('image-uploads');
        $feature->save();
        
        $feature->enable();
        $feature->save();
        $this->assertTrue(Feature::enabled('image-uploads'));
        
        $feature->disable();
        $feature->save();
        $this->assertFalse(Feature::enabled('image-uploads'));
    }
}
