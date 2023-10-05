<?php

namespace User\Domain\Repository;

use User\Domain\UserCredential;

interface UserCredentialRepository
{
    public function save(UserCredential $credential): void;
}