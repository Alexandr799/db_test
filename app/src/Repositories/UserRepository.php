<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function getUser(int $userId)
    {
        $res = $this->findOneBy(['user_id' => $userId]);
        return $res;
    }


    public function activateUser(int $userId): bool
    {
        $em = $this->getEntityManager();
        try {
            $em->beginTransaction();
            $user = $this->getUser($userId);

            if (empty($user)) {
                $em->rollback();
                return false;
            } else if ($user->getActive()) {
                $em->rollback();
                return false;
            } else {
                $user->setActive(true);
                $em->flush();
                $em->commit();
                return true;
            }

        } catch (\Exception $e) {
            $em->rollback();
            throw $e;
        }
    }
}