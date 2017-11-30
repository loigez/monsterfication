<?php
// src/AppBundle/Repository/MonstersRepository.php

namespace AppBundle\Repository;


use AppBundle\Entity\Badge;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;

class UserBadgeProgressRepository extends EntityRepository
{

    /**
     * @param Badge $badge
     * @param User $user
     * @return array
     */
    public function findBadgeProgressForUser(Badge $badge, User $user)
    {
        $query = $this->getEntityManager()->createQuery(
            'SELECT ubp
             FROM AppBundle:UserBadgeProgress ubp
             WHERE ubp.user = :userToFind
             AND ubp.badge = :badgeToFind'
        )->setParameter('userToFind', $user)
            ->setParameter('badgeToFind', $badge);

        return $query->getSingleResult();
    }

}