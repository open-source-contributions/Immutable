<?php
declare(strict_types = 1);

namespace Innmind\Immutable;

/**
 * @template T
 *
 * @param Set<T>|Sequence<T> $structure
 *
 * @return list<T>
 */
function unwrap($structure): array
{
    /** @psalm-suppress DocblockTypeContradiction */
    if (!$structure instanceof Set && !$structure instanceof Sequence) {
        $given = Type::determine($structure);

        throw new \TypeError("Argument 1 must be of type Set|Sequence, $given given");
    }

    /**
     * @psalm-suppress MixedAssignment
     *
     * @var list<T>
     */
    return $structure->reduce(
        [],
        static function(array $carry, $t): array {
            $carry[] = $t;

            return $carry;
        },
    );
}

/**
 * @throws \TypeError
 */
function assertSet(string $type, Set $set, int $position): void
{
    if (!$set->isOfType($type)) {
        throw new \TypeError("Argument $position must be of type Set<$type>, Set<{$set->type()}> given");
    }
}

/**
 * @throws \TypeError
 */
function assertMap(string $key, string $value, Map $map, int $position): void
{
    if (!$map->isOfType($key, $value)) {
        throw new \TypeError("Argument $position must be of type Map<$key, $value>, Map<{$map->keyType()}, {$map->valueType()}> given");
    }
}

/**
 * @throws \TypeError
 */
function assertSequence(string $type, Sequence $sequence, int $position): void
{
    if (!$sequence->isOfType($type)) {
        throw new \TypeError("Argument $position must be of type Sequence<$type>, Sequence<{$sequence->type()}> given");
    }
}
