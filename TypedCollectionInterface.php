<?php
declare(strict_types = 1);

namespace Innmind\Immutable;

interface TypedCollectionInterface extends CollectionInterface
{
    /**
     * Return the type of the collection
     *
     * It usually will be a class name
     *
     * @return string
     */
    public function getType(): string;

    /**
     * Same as getType but without the get
     *
     * @return setring
     */
    public function type(): string;
}
