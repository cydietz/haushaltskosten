<?php

namespace Hako\Model;

class Spending
{
    public $id;
    public $store;
    public $price;
    public $date;

    public function exchangeArray(array $data)
    {
        $this->id       = !empty($data['id']) ? $data['id'] : null;
        $this->store    = !empty($data['store']) ? $data['store'] : null;
        $this->price    = !empty($data['price']) ? $data['price'] : null;
        $this->date     = !empty($data['date']) ? $data['date'] : null;
    }
}