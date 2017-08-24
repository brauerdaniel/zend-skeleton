<?php

namespace Blog\Controller;

use Blog\Service\BlogService;
use Interop\Container\ContainerInterface;
use Zend\Form\FormElementManager\FormElementManagerV3Polyfill;
use Zend\ServiceManager\Factory\FactoryInterface;
use Blog\Form\ArtikelForm;

class BlogControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $blogService = $container->get(BlogService::class);
        /** @var FormElementManagerV3Polyfill $formElementManager */
        $formElementManager = $container->get('FormElementManager');
        /** @var ArtikelForm $artikelForm */
        $artikelForm = $formElementManager->get(ArtikelForm::class);
        return new BlogController($blogService, $artikelForm);

    }
}

