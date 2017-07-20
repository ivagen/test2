<?php

namespace AppBundle\Repository;

/**
 * Class DataRepository
 *
 * @package AppBundle\Repository
 */
class DataRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Find data by params
     *
     * @param array $params
     *
     * @return array
     */
    public function findData($params = [])
    {
        $queryBuilder = $this->createQueryBuilder('d');

        foreach (array_filter($params) as $k => $v) {
            switch ($k) {
                case 'id':
                    $queryBuilder->andWhere('d.id = :id')
                        ->setParameter('id', $v);
                    break;
                case 'method':
                    $queryBuilder->andWhere('d.method = :method')
                        ->setParameter('method', $v);
                    break;
                case 'route':
                    $queryBuilder->andWhere('d.route = :route')
                        ->setParameter('route', $v);
                    break;
                case 'ip':
                    $queryBuilder->andWhere('d.ip = :ip')
                        ->setParameter('ip', $v);
                    break;
                case 'last_days':
                    $queryBuilder->andWhere('d.created > :created')
                        ->setParameter('created', (new \DateTime('- '.intval($v).' days'))->format('Y-m-d H:i:s'));
                    break;
                case 'search':
                    $queryBuilder->andWhere('d.headers LIKE :search OR d.body LIKE :search')
                        ->setParameter('search', '%'.$v.'%');
                    break;
            }
        }

        return $queryBuilder
            ->getQuery()
            ->getResult();
    }
}
