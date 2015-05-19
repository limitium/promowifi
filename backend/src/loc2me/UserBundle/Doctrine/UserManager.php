<?php


namespace loc2me\UserBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Doctrine\UserManager as BaseUserManager;
use FOS\UserBundle\Util\CanonicalizerInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class UserManager extends BaseUserManager
{

    /**
     * {@inheritDoc}
     */
    public function findUserBy(array $criteria)
    {

        $where = [];

        foreach ($criteria as $k => $v) {
            $where[] = 'u.' . $k . '=:' . $k;
        }

        $query = $this->repository
            ->createQueryBuilder('u')
            ->select('u')
//            ->select('u,s,b,ct,t,c')
//            ->leftJoin('u.Settings', 's')
//            ->leftJoin('u.Balance', 'b')
//            ->leftJoin('b.CurrentTariff', 'ct')
//            ->leftJoin('b.Currency', 'c')
//            ->leftJoin('ct.Tariff', 't')
            ->where(implode(' and ', $where))
            ->setParameters($criteria);

        return $query
            ->getQuery()
            ->getOneOrNullResult();
    }
}
