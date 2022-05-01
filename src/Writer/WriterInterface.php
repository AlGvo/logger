<?php

namespace Logger\Writer;

interface WriterInterface
{
    public function write(array $data);
}