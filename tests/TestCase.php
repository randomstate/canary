<?php


namespace RandomState\Canary\Tests;


use RandomState\Canary\CanaryServiceProvider;
use RandomState\Canary\Tests\fixtures\TestServiceProvider;

class TestCase extends \Tests\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->app->register(CanaryServiceProvider::class);
        $this->app->register(TestServiceProvider::class);
        $this->artisan('migrate')->run();
    }
}
