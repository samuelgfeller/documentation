<?php

final class Hydrator
{
    /**
     * Hydrate a collection of objects with data from an array with multiple items.
     *
     * Source: https://github.com/odan/slim4-skeleton/blob/master/src/Support/Hydrator.php
     *
     * @template T
     *
     * @param array $rows The items
     * @param class-string<T> $class The FQN
     *
     * @return T[] The list of object
     */
    public function hydrate(array $rows, string $class): array
    {
        /** @var T[] $result */
        $result = [];

        foreach ($rows as $row) {
            $result[] = new $class($row);
        }

        return $result;
    }
}
