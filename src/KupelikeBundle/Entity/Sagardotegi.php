<?php

namespace KupelikeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sagardotegi
 *
 * @ORM\Table(name="sagardotegi")
 * @ORM\Entity(repositoryClass="KupelikeBundle\Repository\SagardotegiRepository")
 */
class Sagardotegi
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
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255)
     */
    private $direccion;

    /**
     * @var float
     *
     * @ORM\Column(name="latitud", type="float", nullable=true)
     */
    private $latitud;

    /**
     * @var float
     *
     * @ORM\Column(name="longitud", type="float", nullable=true)
     */
     
    private $longitud;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;
    
     /**
     * @var string
     *
     * @ORM\Column(name="horario", type="string", length=255, nullable=true)
     */
    private $horario;

    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="string", length=255, nullable=true)
     */
     
     
    private $foto;
    
    /**
     * @var string
     *
     * @ORM\Column(name="pueblo", type="string", length=255, nullable=true)
     */
    private $pueblo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="id_sagardotegi_facebook", type="string", length=255, unique=true, nullable=true)
     * @ORM\ManyToOne(targetEntity="Kupela")
     * @ORM\JoinColumn(name="id_sagardotegi", referencedColumnName="id_sagardotegi")
     */
    private $idSagardotegiFacebook;


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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Sagardotegi
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Sagardotegi
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set latitud
     *
     * @param float $latitud
     *
     * @return Sagardotegi
     */
    public function setLatitud($latitud)
    {
        $this->latitud = $latitud;

        return $this;
    }

    /**
     * Get latitud
     *
     * @return float
     */
    public function getLatitud()
    {
        return $this->latitud;
    }

    /**
     * Set longitud
     *
     * @param float $longitud
     *
     * @return Sagardotegi
     */
    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;

        return $this;
    }

    /**
     * Get longitud
     *
     * @return float
     */
    public function getLongitud()
    {
        return $this->longitud;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Sagardotegi
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    
    
     /**
     * Set horario
     *
     * @param string $horario
     *
     * @return Sagardotegi
     */
    public function setHorario($horario)
    {
        $this->horario = $horario;

        return $this;
    }

    /**
     * Get horario
     *
     * @return string
     */
    public function getHorario()
    {
        return $this->horario;
    }

    /**
     * Set foto
     *
     * @param string $foto
     *
     * @return Sagardotegi
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get foto
     *
     * @return string
     */
    public function getFoto()
    {
        return $this->foto;
    }
    
    /**
     * Set pueblo
     *
     * @param string $pueblo
     *
     * @return Sagardotegi
     */
    public function setPueblo($pueblo)
    {
        $this->pueblo = $pueblo;

        return $this;
    }

    /**
     * Get pueblo
     *
     * @return string
     */
    public function getPueblo()
    {
        return $this->pueblo;
    }
    
    /**
     * Set idSagardotegiFacebook
     *
     * @param string $idSagardotegiFacebook
     *
     * @return Sagardotegi
     */
    public function setIdSagardotegiFacebook($idSagardotegiFacebook)
    {
        //$this->id_sagardotegi_facebook = $idSagardotegiFacebook;
        $this->idSagardotegiFacebook = $idSagardotegiFacebook;

        return $this;
    }

    /**
     * Get idSagardotegiFacebook
     *
     * @return string
     */
    public function getIdSagardotegiFacebook()
    {
        //return $this->id_sagardotegi_facebook;
        return $this->idSagardotegiFacebook;
    }
}

