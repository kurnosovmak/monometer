<?php declare(strict_types=1);

namespace Monometer;

use Monometer\Driver\Contract\DriverInterface;
use Monometer\Exception\DriverExistsException;
use Monometer\Exception\DriverNotSelectedException;
use Monometer\Exception\NotFoundDriverException;
use Monometer\Implementation\Contract\MetricInterface;

class Monometer
{
    /**
     * @var array<string, callable(): DriverInterface>
     */
    private array $drivers;

    private ?string $selectedDriver;

    public function __construct(
        array $defaultDrivers = [],
    ) {
        $this->drivers = $defaultDrivers;
    }

    /**
     * @param  callable(): DriverInterface $driver
     * @throws DriverExistsException
     */
    public function addDriver(string $alias, callable $driver): void
    {
        if ($this->isExistsDriver($alias)) {
            throw new DriverExistsException();
        }
        $this->drivers[$alias] = $driver;
    }

    /**
     * @throws NotFoundDriverException
     */
    public function setDefaultDriver(string $alias): void
    {
        if (!$this->isExistsDriver($alias)) {
            throw new NotFoundDriverException();
        }

        $this->selectedDriver = $alias;
    }

    public function getInstance(?string $alias = null): MetricInterface
    {
        $alias = $alias ?? $this->selectedDriver;
        if ($alias === null) {
            throw new DriverNotSelectedException();
        }

        if (!$this->isExistsDriver($alias)) {
            throw new NotFoundDriverException();
        }

        return $this->drivers[$alias]()->getInstance();
    }

    private function isExistsDriver(string $alias): bool
    {
        return array_key_exists($alias, $this->drivers);
    }

    public function getDrivers()
    {
        //        var_dump($this->drivers);
    }
}
