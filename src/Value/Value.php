<?php declare(strict_types=1);

namespace Monometer\Value;

class Value
{
    /**
     * @param array<int, string> $tags
     * @param float[]            $values
     */
    public function __construct(
        private readonly array $tags,
        private readonly array $values,
        private readonly float $count,
        private readonly int   $ts,
    ) {
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function getValues(): array
    {
        return $this->values;
    }

    public function getCount(): float
    {
        return $this->count;
    }

    public function getTs(): int
    {
        return $this->ts;
    }
}
