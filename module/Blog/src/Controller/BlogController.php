<?php

namespace Blog\Controller;

use Blog\Form\ArtikelForm;
use Blog\Service\BlogService;
use Zend\Http\PhpEnvironment\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Blog\Entity\Artikel;

/**
 * Class BlogController
 * @package Blog\Controller
 * @method \Zend\Mvc\Plugin\FlashMessenger\FlashMessenger flashMessenger()
 */
class BlogController extends AbstractActionController
{
    private $blogService;
    private $artikelForm;

    /**
     * BlogController constructor.  Doc block
     * @param BlogService $blogService
     * @param ArtikelForm $artikelForm
     */
    public function __construct(BlogService $blogService, ArtikelForm $artikelForm)
    {
        $this->blogService = $blogService;
        $this->artikelForm = $artikelForm;
    }

    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        $artikel = $this->blogService->getAll();
        $viewModel = new ViewModel();
        $viewModel->setVariable("alleArtikel", $artikel);
        return $viewModel;
    }

    public function addAction()
    {
        $form = $this->artikelForm;

        /** @var $request Request */
        $request = $this->getRequest();
        $artikel = new Artikel();
        $form->bind($artikel);

        if ($request->isPost()) {
            $post = $request->getPost();
            $form->setData($post);
            if ($form->isValid()) {

                /**@var $artikel Artikel */
                $artikel = $form->getData();
                if ($this->blogService->saveData($artikel)) //Artikel Speichern + Überprüfung
                {
                    $this->flashMessenger()->addSuccessMessage('Der Artikel wurde erfolgreich gespeichert');
                    return $this->redirect()->toRoute('blog'); // Weiterleitung
                }
                $this->flashMessenger()->addErrorMessage('Der Artikel konnte nicht gespeichert werden. Versuchen Sie es bitte erneut');
            }
        }
        $viewModel = new ViewModel();
        $viewModel->setVariable("hinzufuegen", $form);
        return $viewModel;
    }


    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id', 0);
        $artikel = $this->blogService->findArtikel($id);
        if (!$artikel) {
            return $this->notFoundAction();
        }
        /** @var $request Request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Nein');
            /**@var $artikel Artikel */
            if ($del == 'Ja') {
                $this->blogService->deleteData($artikel);
                $this->flashMessenger()->addSuccessMessage('Der Artikel wurde erfolgreich gelöscht');
            }
            $this->flashMessenger()->addErrorMessage('Der Artikel konnte nicht gelöscht werden. Versuchen Sie es bitte erneut');
            return $this->redirect()->toRoute('blog');
        }
        $viewModel = new ViewModel();
        $viewModel->setVariable('loeschen', $artikel);
        return $viewModel;

    }

    public function editAction()
    {
        $id = $this->params()->fromRoute('id', 0);
        $artikel = $this->blogService->findArtikel($id);
        if (!$artikel) {
            return $this->notFoundAction();
        }
        $form = $this->artikelForm;

        /** @var $request Request */
        $request = $this->getRequest();
        $form->bind($artikel);

        if ($request->isPost()) {
            $post = $request->getPost();
            $form->setData($post);
            if ($form->isValid()) {

                /**@var $artikel Artikel */
                $artikel = $form->getData();
                if ($this->blogService->saveData($artikel)) //Artikel Speichern + Überprüfung
                {
                    $this->flashMessenger()->addSuccessMessage('Der Artikel wurde erfolgreicht gespeichert.');
                    return $this->redirect()->toRoute('blog'); // Weiterleitung
                }
                $this->flashMessenger()->addErrorMessage('Der Artikel konnte nicht gespeichert werden. Versuchen Sie es bitte erneut');
            }

        }
        $viewModel = new ViewModel();
        $viewModel->setVariable("bearbeiten", $form);
        return $viewModel;
    }

    public function showAction()
    {
        $id = $this->params()->fromRoute('id', 0);
        $artikel = $this->blogService->findArtikel($id);
        if (!$artikel) {
            return $this->notFoundAction();
        }
        $viewModel = new ViewModel();
        $viewModel->setVariable("show", $artikel);
        return $viewModel;
    }

    public function aktivierenAction()
    {
        $id = $this->params()->fromRoute('id', 0);
        $artikel = $this->blogService->findArtikel($id);
        if(!$artikel){
         return $this->notFoundAction();
        }
        /**@var $artikel Artikel */
        $this->blogService->aktivieren($artikel);
        $this->flashMessenger()->addSuccessMessage('Der Artikel wurde erfolgreich aktiviert.');
        return $this->redirect()->toRoute('blog');
    }

    public function deaktivierenAction()
    {
        $id = $this->params()->fromRoute('id', 0);
        $artikel = $this->blogService->findArtikel($id);
        if(!$artikel){
            return $this->notFoundAction();
        }
        /**@var $artikel Artikel */
        $this->blogService->deaktivieren($artikel);
        $this->flashMessenger()->addSuccessMessage('Der Artikel wurde erfolgreich deaktiviert.');
        return $this->redirect()->toRoute('blog');
    }

}