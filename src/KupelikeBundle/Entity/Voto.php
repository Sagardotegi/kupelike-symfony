<?php

namespace KupelikeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Voto
 *
 * @ORM\Table(name="voto")
 * @ORM\Entity(repositoryClass="KupelikeBundle\Repository\VotoRepository")
 */
class Voto
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="kupela_id", type="integer")
     */
    private $kupelaId;

    /**
     * @var int
     *
     * @ORM\Column(name="cliente_id", type="integer")
     */
    private $clienteId;

    /**
     * @var string
     *
     * @ORM\Column(name="fecha", type="string", length=255)
     */
    private $fecha;


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
     * Set kupelaId
     *
     * @param integer $kupelaId
     *
     * @return Voto
     */
    public function setKupelaId($kupelaId)
    {
        $this->kupelaId = $kupelaId;

        return $this;
    }

    /**
     * Get kupelaId
     *
     * @return int
     */
    public function getKupelaId()
    {
        return $this->kupelaId;
    }

    /**
     * Set clienteId
     *
     * @param integer $clienteId
     *
     * @return Voto
     */
    public function setClienteId($clienteId)
    {
        $this->clienteId = $clienteId;

        return $this;
    }

    /**
     * Get clienteId
     *
     * @return int
     */
    public function getClienteId()
    {
        return $this->clienteId;
    }

    /**
     * Set fecha
     *
     * @param string $fecha
     *
     * @return Voto
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return string
     */
    public function getFecha()
    {
        return $this->fecha;
    }
}

