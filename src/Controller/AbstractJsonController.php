<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class AbstractJsonController extends AbstractController
{
    /**
     * @return User|object|null
     */
    public function getUser()
    {
        return parent::getUser();
    }

    /**
     * @param $data
     * @param int $status
     * @param array $headers
     * @param array $context
     * @return JsonResponse
     */
    protected function json($data, int $status = 200, array $headers = [], array $context = []): JsonResponse
    {
        //return parent::json(['response' => $data], $status, $headers, $context);
        return parent::json($data, $status, $headers, $context);
    }

}
