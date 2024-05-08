<?php declare(strict_types=1);

namespace Monometer\Value;

class Counter
{
    /**
     * @param array<int, string> $tags
     */
    public function __construct(
        private readonly array $tags,
        private readonly float $count,
        private readonly int   $ts,
    ) {
    }

    public function getTags(): array
    {
        return $this->tags;
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
