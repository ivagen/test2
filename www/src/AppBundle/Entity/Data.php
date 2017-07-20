<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;

/**
 * Data
 *
 * @ORM\Table(name="data")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DataRepository")
 * @ExclusionPolicy("all")
 */
class Data
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"data"})
     * @Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="headers", type="text", nullable=true)
     * @Groups({"data"})
     * @Expose
     */
    private $headers;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text", nullable=true)
     * @Groups({"data"})
     * @Expose
     */
    private $body;

    /**
     * @var string
     *
     * @ORM\Column(name="route", type="string", length=125)
     * @Groups({"data"})
     * @Expose
     */
    private $route;

    /**
     * @var string
     *
     * @ORM\Column(name="method", type="string", length=32, nullable=false)
     * @Groups({"data"})
     * @Expose
     */
    private $method;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=32)
     * @Groups({"data"})
     * @Expose
     */
    private $ip;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     * @Groups({"data"})
     * @Expose
     */
    private $created;

    /**
     * Data constructor.
     */
    public function __construct()
    {
        $this->created = new \DateTime('now');
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get headers
     *
     * @return string
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Set headers
     *
     * @param string $headers
     *
     * @return Data
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return Data
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get route
     *
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Set route
     *
     * @param string $route
     *
     * @return Data
     */
    public function setRoute($route)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Get method
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set method
     *
     * @param string $method
     *
     * @return Data
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return Data
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Data
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }
}
