<?php

namespace Logger\Writer;

use Logger\Formater\FormatterInterface;

class FileWriter implements WriterInterface
{
    private string $dir = __DIR__.'/../log/';
    private string $defaultFile = 'logger';
    private string $extends = '.log';
    private FormatterInterface $formatter;
    public string $format = '{date} {level} {message} {context}';

    public function __construct(FormatterInterface $formatter)
    {
        $this->formatter = $formatter;
    }

    public function write(array $data)
    {
        $message = $this->formatter->format($this->format, $data) . PHP_EOL;
        if (! is_dir($this->dir)) {
            mkdir($this->dir);
        }
        $filename = $this->dir . $this->defaultFile . $this->extends;
        file_put_contents($filename, $message, FILE_APPEND | LOCK_EX);
    }
}