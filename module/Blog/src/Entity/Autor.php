<?php
namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="autoren")
 */
class Autor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="ID")
     */
    protected $id;

    /**
     * @ORM\Column(name="Vorname")
     */
    protected $vorname;

    /**
     * @ORM\Column(name="Nachname")
     */
    protected $nachname;

    /**
     * @ORM\Column(name="Kuerzel")
     */
    protected $kuerzel;

    public function __toString()
    {
     return sprintf( '%s %s (%s)', $this->getVorname(), $this->getNachname(), $this->getKuerzel());
    }

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
    public function getVorname()
    {
        return $this->vorname;
    }

    /**
     * @param mixed $vorname
     */
    public function setVorname($vorname)
    {
        $this->vorname = $vorname;
    }

    /**
     * @return mixed
     */
    public function getNachname()
    {
        return $this->nachname;
    }

    /**
     * @param mixed $nachname
     */
    public function setNachname($nachname)
    {
        $this->nachname = $nachname;
    }

    /**
     * @return mixed
     */
    public function getKuerzel()
    {
        return $this->kuerzel;
    }

    /**
     * @param mixed $kuerzel
     */
    public function setKuerzel($kuerzel)
    {
        $this->kuerzel = $kuerzel;
    }
}