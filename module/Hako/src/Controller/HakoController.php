<?php

namespace Hako\Controller;

use Hako\Model\SpendingTable;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Hako\Form\SpendingForm;
use Hako\Model\Spending;

class HakoController extends AbstractActionController
{
    private $table;

    public function __construct(SpendingTable $table)
    {
        $this->table = $table;
    }

    public function indexAction()
    {
        return new ViewModel([
            'spendings' => $this->table->fetchAll(),
        ]);
    }

    public function addAction()
    {
        $form = new SpendingForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (! $request->isPost()) {
            return ['form' => $form];
        }

        $spending = new Spending();
        $form->setInputFilter($spending->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return ['form' => $form];
        }

        $spending->exchangeArray($form->getData());
        $this->table->saveSpending($spending);
        return $this->redirect()->toRoute('hako');
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if (0 === $id) {
            return $this->redirect()->toRoute('hako', ['action' => 'add']);
        }

        // Retrieve the album with the specified id. Doing so raises
        // an exception if the album is not found, which should result
        // in redirecting to the landing page.
        try {
            $spending = $this->table->getSpending($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('hako', ['action' => 'index']);
        }

        $form = new SpendingForm();
        $form->bind($spending);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];

        if (! $request->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($spending->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return $viewData;
        }

        try {
            $this->table->saveSpending($spending);
        } catch (\Exception $e) {
        }

        // Redirect to spending list
        return $this->redirect()->toRoute('hako', ['action' => 'index']);
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('hako');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->table->deleteSpending($id);
            }

            // Redirect to list of albums
            return $this->redirect()->toRoute('hako');
        }

        return [
            'id'    => $id,
            'spending' => $this->table->getSpending($id),
        ];
    }
}