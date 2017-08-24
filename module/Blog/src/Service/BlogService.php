<?php

namespace Blog\Service;

use Doctrine\ORM\EntityManager;
use Blog\Entity\Artikel;

class BlogService
{

    private $entityManager;

    /**
     * BlogService constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getAll()
    {
        return $this->entityManager->getRepository(Artikel::class)
            ->findall();

    }


    /**
     * @param Artikel $artikel
     * @return boolean
     */
    public function saveData(Artikel $artikel)
    {
        try {
            $this->entityManager->persist($artikel);
            $this->entityManager->flush();
        } catch (\Exception $exception) {
            return false;
        }
        return true;
    }

    /**
     * @param $id
     * @return null|object
     */
    public function findArtikel($id)
    {
        return $this->entityManager->find(Artikel::class, $id);
    }

    public function deleteData(Artikel $artikel)
    {
        $this->entityManager->remove($artikel);
        $this->entityManager->flush();
    }

    public function aktivieren(Artikel $artikel)
    {
        $artikel->setStatus(1);
        return $this->saveData($artikel);
    }

    public function deaktivieren(Artikel $artikel)
    {
        $artikel->setStatus(0);
        return $this->saveData($artikel);
    }
}