<?php


namespace RandomState\Canary\Tests\Feature\Laravel;


use RandomState\Canary\Laravel\Cage;
use RandomState\Canary\FeatureManager;
use RandomState\Canary\Tests\TestCase;
use RandomState\Canary\Laravel\Feature;
use RandomState\Canary\Laravel\Cageable;
use RandomState\Canary\Tests\fixtures\Entity;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CanaryTest extends TestCase
{
    /**
     * @test
     */
    public function can_enable_feature_for_cage()
    {
        $feature = Feature::named('upload-images');
        $feature->save();

        $cage = Cage::create(['name' => 'test users']);

        $cage->enable($feature);

        $this->assertTrue($cage->can('upload-images'));
    }

    /**
     * @test
     */
    public function can_disable_feature_for_cage()
    {
        $feature = Feature::named('upload-images');
        $feature->save();

        $cage = Cage::create(['name' => 'test users']);

        $cage->enable($feature);
        $cage->disable($feature);

        $this->assertFalse($cage->can('upload-images'));
    }

    /**
     * @test
     */
    public function can_add_cageables_to_cage()
    {
        $cage = new Cage();
        $cage->name = 'test users';
        $cage->save();

        $entity = new Entity();
        $entity2 = new Entity();

        $entity->save();
        $entity2->save();

        $cage->add($entity, $entity2);
        $cage->save();

        $this->assertCount(2, $cage->occupants);
    }

    /**
     * @test
     */
    public function cageable_inherits_enabled_feature_from_cage()
    {
        Feature::named('upload-images')->save();
        $cage = Cage::create([
            'name' => 'test users',
        ]);

        $cage->add($entity = Entity::create());

        $cage->enable('upload-images');
        $cage->save();

        $this->assertCount(1, $entity->cages);
        $this->assertTrue($entity->cages->first()->can('upload-images'));
        $this->assertTrue($entity->can('upload-images'));
    }

    /**
     * @test
     */
    public function cages_can_inherit_from_other_cages()
    {
        Feature::named('upload-images')->save();
        $parent = Cage::create([
            'name' => 'test users',
        ]);

        $parent->enable('upload-images');
        $parent->save();

        $child = Cage::create([
            'name' => 'child users',
        ]);
        
        $parent->add($child);

        $this->assertTrue($child->can('upload-images'));
    }
}
