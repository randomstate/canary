<?php


namespace RandomState\Canary\Tests\fixtures;


use RandomState\Canary\Featured;
use Illuminate\Database\Eloquent\Model;
use RandomState\Canary\Laravel\Traits\Cageable;

class Entity extends Model
{
    use Cageable;
}
