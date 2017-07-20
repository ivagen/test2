<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class DataService
 *
 * @package AppBundle\Services
 */
class DataService
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * DataService constructor.
     *
     * @param RequestStack $requestStack
     * @param EntityManager $entityManager
     */
    public function __construct(RequestStack $requestStack, EntityManager $entityManager)
    {
        $this->request = $requestStack->getCurrentRequest();
        $this->entityManager = $entityManager;
    }

    /**
     * Search data by params
     *
     * @return array
     */
    public function searchData()
    {
        return $this->entityManager
            ->getRepository('AppBundle:Data')
            ->findData(
                [
                    'id'        => $this->request->get('id'),
                    'method'    => $this->request->get('method'),
                    'route'     => $this->request->get('route'),
                    'ip'        => $this->request->get('ip'),
                    'last_days' => $this->request->get('last_days'),
                    'search'    => $this->request->get('search'),
                ]
            );
    }

    /**
     * Get form data
     *
     * @param string $route
     *
     * @return array
     */
    public function getFormData($route)
    {
        return [
            'headers' => (string)$this->request->headers,
            'body'    => $this->request->getContent(),
            'route'   => $route,
            'method'  => $this->request->getMethod(),
            'ip'      => $this->request->getClientIp(),
        ];
    }
}
