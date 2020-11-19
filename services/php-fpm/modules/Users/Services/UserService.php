<?php

namespace Modules\Users\Services;

use \Doctrine\ORM\EntityManager;
use \Modules\Users\Models\User;

class UserService
{
    protected EntityManager $entityManager;
    protected $repository;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository('Modules\Users\Models\User');
    }

    public function userExists(User $user)
    {
        $found = $this->repository->findOneByLogin($user->login);
        if ($found) return $found;

        $found = $this->repository->findOneByEmail($user->email);
        if ($found) return $found;

        return null;
    }
}