<?php declare(strict_types=1);

namespace Monometer\Implementation;

use Monometer\ErrorData;
use Monometer\Implementation\Contract\MetricInterface;
use Monometer\Value\Counter;
use Monometer\Value\Unique;
use Monometer\Value\Value;
use VK\StatsHouse\StatsHouse;

class StatsHouseMetric implements MetricInterface
{
    public function __construct(
        private readonly StatsHouse $statsHouseConnection,
    ) {
    }

    public function sendCounter(string $metricName, Counter $counter): ?ErrorData
    {
        $errorMessage = $this->statsHouseConnection->writeCount($metricName, $counter->getTags(), $counter->getCount(), $counter->getTs());
        if ($errorMessage !== null) {
            return new ErrorData($errorMessage);
        }

        return null;
    }

    public function sendValue(string $metricName, Value $value): ?ErrorData
    {
        $errorMessage = $this->statsHouseConnection->writeValue($metricName, $value->getTags(), $value->getValues(), $value->getCount(), $value->getTs());
        if ($errorMessage !== null) {
            return new ErrorData($errorMessage);
        }

        return null;
    }

    public function sendUnique(string $metricName, Unique $unique): ?ErrorData
    {
        $errorMessage = $this->statsHouseConnection->writeUnique($metricName, $unique->getTags(), $unique->getValues(), $unique->getCount(), $unique->getTs());
        if ($errorMessage !== null) {
            return new ErrorData($errorMessage);
        }

        return null;
    }
}
