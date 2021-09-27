<?php

namespace app;

use League\Csv\Writer;
use League\Csv\Reader;

class Storage
{
    private Writer $writer;
    private Reader $reader;
    public string $url;


    public function __construct(string $url)
    {
        $this->url = $url;
        $this->writer = Writer::createFromPath($url, 'a+');
        $this->reader = Reader::createFromPath($url, "r");

    }

    public function writer(): Writer
    {
        return $this->writer;
    }

    public function reader(): Reader
    {
        return $this->reader;
    }

    public function search(string $search)
    {
        $records = $this->reader->getRecords();
        foreach ($records as $key => $record) {
            if ($record[2] === $search) {
                return $key;
            }
        }
    }

    public function delete(int $index): void
    {
        $records = iterator_to_array($this->reader->getRecords());
        $writer = Writer::createFromPath($this->url, "w+");
        array_splice($records, $index, 1);
        $writer->insertAll($records);


    }


}