<?php

namespace Hako\Model;

use RuntimeException;
use Laminas\Db\TableGateway\TableGatewayInterface;

class SpendingTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function getSpending($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current;
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;
    }

    public function saveSpending(Spending $Spending)
    {
        $data = [
            'store' => $Spending->store,
            'price'  => $Spending->price,
            'date'  => $Spending->date,
        ];

        $id = (int) $Spending->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        try {
            $this->getSpending($id);
        } catch (RuntimeException $e) {
            throw new RuntimeException(sprintf(
                'Cannot update Spending with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteSpending($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}