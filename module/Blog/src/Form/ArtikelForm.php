<?php

namespace Blog\Form;

use DoctrineModule\Form\Element\ObjectSelect;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\Form\Form;
use Zend\Form\Element;
use Doctrine\ORM\EntityManager;
use Blog\Entity\Autor;

class ArtikelForm extends Form
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct('artikel-form');
        $this->setAttribute('method', 'post');
        $this->setInputFilter(new Filter\ArtikelFilter($entityManager));
        $this->setHydrator(new DoctrineObject($entityManager));

        $titel = new Element\Text('titel');  // 'type' => 'text', 'name' => 'titel',
        $titel->setLabel('Titel'); //'options' => ['label' => 'Titel'],
        $titel->setAttribute('id', 'titel');//'attributes' => [ 'id' => 'titel'],
        $titel->setAttribute('class', 'form-control');
        $titel->setAttribute('placeholder', 'Titel eingeben');
        $this->add($titel); //$this->add([]);*/

        $teaser = new Element\Text('teaser');
        $teaser->setLabel('Teaser');
        $teaser->setAttribute('id', 'teaser');
        $teaser->setAttribute('class', 'form-control');
        $teaser->setAttribute('placeholder', 'Teaser eingeben');
        $this->add($teaser);

        $inhalt = new Element\Textarea('inhalt');
        $inhalt->setLabel('Inhalt');
        $inhalt->setAttribute('id', 'inhalt');
        $inhalt->setAttribute('class', 'form-control');
        $inhalt->setAttribute('placeholder', 'Inhalt eingeben');
        $this->add($inhalt);

        $datum = new Element\Date('vDatum');
        $datum->setLabel('Datum');
        $datum->setAttribute('id', 'datum');
        $datum->setAttribute('class', 'form-control');
        $this->add($datum);

        $status = new Element\Select('status');
        $status->setLabel('Status');
        $status->setAttribute('class', 'form-control');
        $status->setEmptyOption('Status auswählen');
        $status->setValueOptions(
            [
                '0' => 'aktiviert',
                '1' => 'deaktiviert'
            ]
        );


        $this->add($status);

        $autor = new ObjectSelect('autor');
        $autor->setLabel('Autor');
        $autor->setAttribute('class', 'form-control');
        $autor->setEmptyOption('Autor auswählen');
        $autor->setOptions(
            [
                'object_manager' => $entityManager,
                'target_class' => Autor::class,
                'property' => 'autor',
                'label_generator' => function(Autor $targetEntity)
                {
                    return sprintf('%s %s (%s)', $targetEntity->getVorname(), $targetEntity->getNachname(), $targetEntity->getKuerzel());
                }
            ]
        );
        $autor->setAttribute('id', 'autor');
        $this->add($autor);

        $submit = new Element\Submit('submit');
        $submit->setAttribute('id', 'submitbutton');
        $submit->setAttribute('class', 'btn btn-primary');
        $submit->setValue('submit');
        $this->add($submit);
    }
}

?>