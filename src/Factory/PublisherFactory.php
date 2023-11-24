<?php

namespace App\Factory;

use App\Entity\Publisher;
use App\Repository\PublisherRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Publisher>
 *
 * @method        Publisher|Proxy                     create(array|callable $attributes = [])
 * @method static Publisher|Proxy                     createOne(array $attributes = [])
 * @method static Publisher|Proxy                     find(object|array|mixed $criteria)
 * @method static Publisher|Proxy                     findOrCreate(array $attributes)
 * @method static Publisher|Proxy                     first(string $sortedField = 'id')
 * @method static Publisher|Proxy                     last(string $sortedField = 'id')
 * @method static Publisher|Proxy                     random(array $attributes = [])
 * @method static Publisher|Proxy                     randomOrCreate(array $attributes = [])
 * @method static PublisherRepository|RepositoryProxy repository()
 * @method static Publisher[]|Proxy[]                 all()
 * @method static Publisher[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Publisher[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Publisher[]|Proxy[]                 findBy(array $attributes)
 * @method static Publisher[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Publisher[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class PublisherFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->company(255),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Publisher $publisher): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Publisher::class;
    }
}
