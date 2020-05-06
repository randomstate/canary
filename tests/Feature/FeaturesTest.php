<?php


namespace RandomState\Canary\Tests\Feature;


use RandomState\Canary\Featurable;
use RandomState\Canary\FeatureManager;
use Tests\TestCase;

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
        $this->assertFalse($this->manager->enabled('image-uploads'));
        $this->manager->enable('image-uploads');
        $this->assertTrue($this->manager->enabled('image-uploads'));
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
        $featurable = new class implements Featurable{
            public function getId()
            {
                return 'id1234';
            }
        };

        $this->manager->enable('image-uploads', $featurable);
        $this->assertFalse($this->manager->enabled('image-uploads'));
        $this->assertTrue($this->manager->enabled('image-uploads', $featurable) );
    }

    /**
     * @test
     */
    public function can_disable_feature_for_specific_entity()
    {
        $featurable = new class implements Featurable{
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