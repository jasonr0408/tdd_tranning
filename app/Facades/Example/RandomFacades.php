<?php
namespace App\Facades\Example;
use Illuminate\Support\Facades\Facade;

/**
 *
 */
class RandomFacades extends Facade
{
/**
 * Get the registered name of the component.
 *
 * @return string
 */
    protected static function getFacadeAccessor()
    {
        return 'Random';
    }
}
