<?php

namespace KupelikeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kupela
 *
 * @ORM\Table(name="kupela")
 * @ORM\Entity(repositoryClass="KupelikeBundle\Repository\KupelaRepository")
 */
class Kupela
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
     * @ORM\Column(name="id_sagardotegi", type="string", length=255)
     * @ORM\OneToMany(targetEntity="Sagardotegi", mappedBy="kupela")
     */
    private $idSagardotegi;

    /**
     * @var int
     *
     * @ORM\Column(name="num_votos", type="integer", nullable=true)
     */
    private $numVotos;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var int
     *
     * @ORM\Column(name="year", type="integer")
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="string", length=255, nullable=true)
     */
    private $foto;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;
    
    /**
     * @var string
     *
     * @ORM\Column(name="id_kupela_facebook", type="string", length=255)
     */
    private $idKupelaFacebook;

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
     * Set idSagardotegi
     * 
     * @param string $idSagardotegi
     *
     * @return Kupela
     */ 
    public function setIdSagardotegi($idSagardotegi)
    {
        $this->idSagardotegi = $idSagardotegi;
        
        return $this;
    }
    
    /**
     * Get idSagardotegi
     * 
     * @return string
     */ 
    public function getIdSagardotegi()
    {
        return $this->idSagardotegi;
    }

    /**
     * Set numVotos
     *
     * @param integer $numVotos
     *
     * @return Kupela
     */
    public function setNumVotos($numVotos)
    {
        $this->numVotos = $numVotos;

        return $this;
    }

    /**
     * Get numVotos
     *
     * @return int
     */
    public function getNumVotos()
    {
        return $this->numVotos;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Kupela
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Kupela
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
     * Set year
     *
     * @param integer $year
     *
     * @return Kupela
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set foto
     *
     * @param string $foto
     *
     * @return Kupela
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
     * Set url
     *
     * @param string $url
     *
     * @return Kupela
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
    
    /**
     * Set idKupelaFacebook
     *
     * @param string $idKupelaFacebook
     *
     * @return Kupela
     */
    public function setIdKupelaFacebook($idKupelaFacebook)
    {
        $this->idKupelaFacebook = $idKupelaFacebook;

        return $this;
    }

    /**
     * Get idKupelaFacebook
     *
     * @return string
     */
    public function getIdKupelaFacebook()
    {
        return $this->idKupelaFacebook;
    }
}

