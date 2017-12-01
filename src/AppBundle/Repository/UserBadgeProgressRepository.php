<?php
// src/AppBundle/Repository/MonstersRepository.php

namespace AppBundle\Repository;

use AppBundle\Entity\State;
use AppBundle\Entity\UserBadgeProgress;
use Doctrine\ORM\EntityRepository;

class UserBadgeProgressRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function findLastActivity()
    {
        $repo = $this->getEntityManager()->getRepository(UserBadgeProgress::class);
        $query = $repo
            ->createQueryBuilder('ubp')
            ->where('ubp.state = :state')
            ->andWhere('ubp.unlockDate IS NOT NULL')
            ->orderBy('ubp.unlockDate', 'DESC')
            ->setFirstResult(0)
            ->setMaxResults(5)
            ->setParameter('state', State::UNLOCKED)
            ->getQuery();

        return $query->getResult();
    }

    /**
     * @return array
     */
    public function findTopTen()
    {
        $repo = $this->getEntityManager()->getRepository(UserBadgeProgress::class);
        $query = $repo
            ->createQueryBuilder('ubp')
            ->addSelect('COUNT(ubp.id) as counter')
            ->where('ubp.state = :state')
            ->add('orderBy','counter DESC, ubp.unlockDate DESC')
            //->orderBy('counter', 'DESC')
            //->orderBy('ubp.unlockDate', 'DESC')
            ->groupBy('ubp.user')
            ->setFirstResult(0)
            ->setMaxResults(5)
            ->setParameter('state', State::UNLOCKED)
            ->getQuery();

        return $query->getResult();
    }
}