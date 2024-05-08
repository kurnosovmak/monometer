<?php declare(strict_types=1);

namespace Monometer\Driver\Contract;

use Monometer\Implementation\Contract\MetricInterface;

interface DriverInterface
{
    public function getInstance(): MetricInterface;
}
