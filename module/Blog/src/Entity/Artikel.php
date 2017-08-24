<?php
namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="artikel")
 */
class Artikel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="ID")
     */
    protected $id;

    /**
     * @ORM\Column(name="Titel")
     */
    protected $titel;

    /**
     * @ORM\Column(name="Teaser")
     */
    protected $teaser;

    /**
     * @ORM\Column(name="Inhalt")
     */
    protected $inhalt;

    /**
     * @ORM\Column(name="Status")
     */
    protected $status;

    /**
    * @ORM\Column(name="Veroeffentlichungsdatum", type="datetime")
    */
    protected $vDatum;

    /**
     * @ORM\ManyToOne(targetEntity="Autor")
     * @ORM\JoinColumn(name="AutorID", referencedColumnName="ID")
     */
    protected $autor;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitel()
    {
        return $this->titel;
    }

    /**
     * @param mixed $titel
     */
    public function setTitel($titel)
    {
        $this->titel = $titel;
    }

    /**
     * @return mixed
     */
    public function getTeaser()
    {
        return $this->teaser;
    }

    /**
     * @param mixed $teaser
     */
    public function setTeaser($teaser)
    {
        $this->teaser = $teaser;
    }

    /**
     * @return mixed
     */
    public function getInhalt()
    {
        return $this->inhalt;
    }

    /**
     * @param mixed $inhalt
     */
    public function setInhalt($inhalt)
    {
        $this->inhalt = $inhalt;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getVDatum()
    {
        return $this->vDatum;
    }

    /**
     * @param mixed $vDatum
     */
    public function setVDatum($vDatum)
    {
        $this->vDatum = $vDatum;
    }

    /**
     * @return Autor
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * @param mixed $autor
     */
    public function setAutor($autor)
    {
        $this->autor = $autor;
    }

}
