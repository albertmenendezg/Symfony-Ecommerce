<?php

declare(strict_types=1);

namespace Shared\Infrastructure\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

abstract class DoctrineAbstractRepository
{

    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function em(): EntityManagerInterface
    {
        return $this->em;
    }

    public function repository(): EntityRepository
    {
        return $this->em->getRepository($this->entityRepositoryClass());
    }

    public abstract function entityRepositoryClass(): string;
}