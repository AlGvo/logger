<?php

namespace Logger\Formater;

interface FormatterInterface
{
    public function format(string $format, array $data);
}