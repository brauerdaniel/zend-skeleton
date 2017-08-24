<?php

namespace Blog\Form\Filter;

use Blog\Entity\Autor;
use Doctrine\ORM\EntityManager;
use Zend\InputFilter\InputFilter;
use Zend\Filter;
use Zend\Validator;
use DoctrineModule\Validator\ObjectExists;

class ArtikelFilter extends InputFilter
{
    public function __construct(EntityManager $entityManager)
    {
        $this->add([
            'name' => 'titel',
            'required' => true,
            'filters' => [
                ['name' => Filter\StripTags::class],
                ['name' => Filter\StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => Validator\StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
            ],
        ]);

        $this->add([
            'name' => 'teaser',
            'required' => true,
            'filters' => [
                ['name' => Filter\StripTags::class],
                ['name' => Filter\StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => Validator\StringLength::class,

                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
            ],
        ]);

        $this->add([
            'name' => 'inhalt',
            'required' => true,
            'filters' => [
                ['name' => Filter\StripTags::class],
                ['name' => Filter\StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => Validator\StringLength::class,

                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 10,
                        'max' => 1000,
                    ],
                ],
            ],
        ]);

        $this->add([
            'name' => 'status',
            'reqiured' => true,
            'validators' => [
                [
                    'name' => Validator\InArray::class,
                    'options' => [
                        'haystack' => [
                            0, 1
                        ],
                    ],
                ],
            ],
        ]);

        $this->add([
            'name' => 'autor',
            'required' => true,
            'validators' => [
                [
                    'name' => ObjectExists::class,
                    'options' => [
                        'object_repository' => $entityManager->getRepository(Autor::class),
                        'fields' => ['id'],
                    ],
                ],
            ],
        ]);
    }
}