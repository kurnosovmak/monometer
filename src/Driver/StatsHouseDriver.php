<?php declare(strict_types=1);

namespace Monometer\Driver;

use Monometer\Driver\Contract\DriverInterface;
use Monometer\Implementation\Contract\MetricInterface;
use Monometer\Implementation\StatsHouseMetric;
use VK\StatsHouse\StatsHouse;

class StatsHouseDriver implements DriverInterface
{
    private ?StatsHouseMetric $statsHouseMetric = null;

    public function __construct(
        private readonly StatsHouse $connection,
    ) {
    }

    public function getInstance(): MetricInterface
    {
        if ($this->statsHouseMetric === null) {
            $this->statsHouseMetric = new StatsHouseMetric($this->connection);
        }

        return $this->statsHouseMetric;
    }
}
