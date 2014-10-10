<?php

namespace Blogger\BlogBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Description of BlogRepository
 *
 * @author seyfer
 */
class BlogRepository extends EntityRepository
{

    public function getLatestBlogs($limit = null)
    {
        $qb = $this->createQueryBuilder('b')
                ->select('b')
                ->addOrderBy('b.created', 'DESC');

        if (false === is_null($limit)) {
            $qb->setMaxResults($limit);
        }

        return $qb->getQuery()->getResult();
    }

}
