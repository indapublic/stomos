<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

final class TaskRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Task::class);
    }

    /**
     * @param array $order
     *
     * @return QueryBuilder
     */
    public function fetchList(array $order = []): QueryBuilder
    {
        $qb = $this->createQueryBuilder('t');

        if (!empty($order)) {
            dd($order);
        }

        return $qb;
    }
}
