<?php

namespace app;

use League\Csv\Writer;
use League\Csv\Reader;

class Pdl
{
    private Writer $writer;
    private Reader $reader;


    public function __construct()
    {
        $this->writer = Writer::createFromPath('app/data.csv', 'a+');
        $this->reader = Reader::createFromPath("app/data.csv", "r");

    }

    public function writer(): Writer
    {
        return $this->writer;
    }

    public function reader(): Reader
    {
        return $this->reader;
    }

    public function search(string $code): array
    {
        $result = [];
        $iterable = $this->reader()->getRecords();
        foreach ($iterable as $array) {
            if (in_array($code, $array)) {
                $result = $array;
            }

        }
        return $result;
    }

    public function delete(string $result)
    {
        $iterable = $this->reader()->getRecords();
        foreach ($iterable as $array) {
            if ($array == $this->search($result)) {
                unset($array);
            }
        }
    }
}