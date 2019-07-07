<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Ator;

class AtorRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ator::class);
    }
}