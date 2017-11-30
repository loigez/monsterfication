<?php
// src/AppBundle/Repository/MonstersRepository.php

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class UserBadgeProgressRepository extends EntityRepository
{

    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT m FROM AppBundle:Monsters m ORDER BY m.name ASC'
            )
            ->getResult();
    }

}