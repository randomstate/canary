<?php


namespace RandomState\Canary\Tests\Feature;

use RandomState\Canary\Featured;
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
        $this->manager->enable('image-uploads');
        $this->manager->disable('image-uploads');
        $this->assertFalse($this->manager->enabled('image-uploads'));
    }

    /**
     * @test
     */
    public function can_enable_feature_for_specific_entity()
    {
        $featurable = new class implements Featured
        {
            public function getId()
            {
                return 'id1234';
            }
        };

        $this->manager->enable('image-uploads', $featurable);
        $this->assertFalse($this->manager->enabled('image-uploads'));
        $this->assertTrue($this->manager->enabled('image-uploads', $featurable));
    }

    /**
     * @test
     */
    public function can_disable_feature_for_specific_entity()
    {
        $featurable = new class implements Featured
        {
            public function getId()
            {
                return 'id1234';
            }
        };

        $this->manager->enable('image-uploads', $featurable);
        $this->manager->disable('image-uploads', $featurable);
        $this->assertFalse($this->manager->enabled('image-uploads', $featurable));
    }
}
