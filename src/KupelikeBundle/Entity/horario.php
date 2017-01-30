<?php

namespace KupelikeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * horario
 *
 * @ORM\Table(name="horario")
 * @ORM\Entity(repositoryClass="KupelikeBundle\Repository\horarioRepository")
 */
class horario
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
     * @ORM\Column(name="sagardotegi_id", type="integer")
     */
    private $sagardotegiId;

    /**
     * @var string
     *
     * @ORM\Column(name="lunes", type="string", length=255, nullable=true)
     */
    private $lunes;

    /**
     * @var string
     *
     * @ORM\Column(name="martes", type="string", length=255, nullable=true)
     */
    private $martes;

    /**
     * @var string
     *
     * @ORM\Column(name="miercoles", type="string", length=255, nullable=true)
     */
    private $miercoles;

    /**
     * @var string
     *
     * @ORM\Column(name="jueves", type="string", length=255, nullable=true)
     */
    private $jueves;

    /**
     * @var string
     *
     * @ORM\Column(name="viernes", type="string", length=255, nullable=true)
     */
    private $viernes;

    /**
     * @var string
     *
     * @ORM\Column(name="sabado", type="string", length=255, nullable=true)
     */
    private $sabado;

    /**
     * @var string
     *
     * @ORM\Column(name="domingo", type="string", length=255, nullable=true)
     */
    private $domingo;


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
     * Set sagardotegiId
     *
     * @param integer $sagardotegiId
     *
     * @return horario
     */
    public function setSagardotegiId($sagardotegiId)
    {
        $this->sagardotegiId = $sagardotegiId;

        return $this;
    }

    /**
     * Get sagardotegiId
     *
     * @return int
     */
    public function getSagardotegiId()
    {
        return $this->sagardotegiId;
    }

    /**
     * Set lunes
     *
     * @param string $lunes
     *
     * @return horario
     */
    public function setLunes($lunes)
    {
        $this->lunes = $lunes;

        return $this;
    }

    /**
     * Get lunes
     *
     * @return string
     */
    public function getLunes()
    {
        return $this->lunes;
    }

    /**
     * Set martes
     *
     * @param string $martes
     *
     * @return horario
     */
    public function setMartes($martes)
    {
        $this->martes = $martes;

        return $this;
    }

    /**
     * Get martes
     *
     * @return string
     */
    public function getMartes()
    {
        return $this->martes;
    }

    /**
     * Set miercoles
     *
     * @param string $miercoles
     *
     * @return horario
     */
    public function setMiercoles($miercoles)
    {
        $this->miercoles = $miercoles;

        return $this;
    }

    /**
     * Get miercoles
     *
     * @return string
     */
    public function getMiercoles()
    {
        return $this->miercoles;
    }

    /**
     * Set jueves
     *
     * @param string $jueves
     *
     * @return horario
     */
    public function setJueves($jueves)
    {
        $this->jueves = $jueves;

        return $this;
    }

    /**
     * Get jueves
     *
     * @return string
     */
    public function getJueves()
    {
        return $this->jueves;
    }

    /**
     * Set viernes
     *
     * @param string $viernes
     *
     * @return horario
     */
    public function setViernes($viernes)
    {
        $this->viernes = $viernes;

        return $this;
    }

    /**
     * Get viernes
     *
     * @return string
     */
    public function getViernes()
    {
        return $this->viernes;
    }

    /**
     * Set sabado
     *
     * @param string $sabado
     *
     * @return horario
     */
    public function setSabado($sabado)
    {
        $this->sabado = $sabado;

        return $this;
    }

    /**
     * Get sabado
     *
     * @return string
     */
    public function getSabado()
    {
        return $this->sabado;
    }

    /**
     * Set domingo
     *
     * @param string $domingo
     *
     * @return horario
     */
    public function setDomingo($domingo)
    {
        $this->domingo = $domingo;

        return $this;
    }

    /**
     * Get domingo
     *
     * @return string
     */
    public function getDomingo()
    {
        return $this->domingo;
    }
}

