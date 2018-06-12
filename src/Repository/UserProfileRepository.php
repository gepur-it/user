<?php


namespace GepurIt\User\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class Repository
 * @package UserProfileBundle\Repository
 */
class UserProfileRepository extends EntityRepository
{
    /**
     * @param array $userIds
     * @return array
     * @throws \Doctrine\ORM\Query\QueryException
     */
    public function loadNamesByIds(array $userIds)
    {
        if (empty($userIds)) {
            return [];
        }
        $queryBuilder = $this->createQueryBuilder('user_profile');
        $query = $queryBuilder
            ->select('user_profile.managerId', 'user_profile.managerName')
            ->where($queryBuilder->expr()->in('user_profile.managerId', $userIds))
            ->indexBy('user_profile', 'user_profile.managerId')
            ->getQuery();

        return $query->getArrayResult();
    }
}
