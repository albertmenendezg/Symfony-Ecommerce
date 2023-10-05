<?php

declare(strict_types=1);

namespace Shared\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class ApiController extends AbstractController
{
    public abstract function exceptions(): array;
}
