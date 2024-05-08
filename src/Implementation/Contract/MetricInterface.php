<?php declare(strict_types=1);

namespace Monometer\Implementation\Contract;

use Monometer\ErrorData;
use Monometer\Value\Counter;
use Monometer\Value\Unique;
use Monometer\Value\Value;

interface MetricInterface
{
    public function sendCounter(string $metricName, Counter $counter): ?ErrorData;

    public function sendValue(string $metricName, Value $value): ?ErrorData;

    public function sendUnique(string $metricName, Unique $unique): ?ErrorData;
}
