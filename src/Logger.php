<?php

namespace Logger;

use Logger\Writer\WriterInterface;
use Psr\Log\AbstractLogger;

class Logger extends AbstractLogger
{
    /** @var $writers WriterInterface[] */
    private array $writers;
//    private WriterInterface $writer;

    public function __construct(array $writers)
    {
        $this->writers = $writers;
    }

    public function log($level, $message, array $context = array())
    {
        $data = [
            'date' => date('Y-m-d H:i:s'),
            'level' => $level,
            'message' => $message,
        ];
        if ($context != []) {
            $data['context'] = $context;
        }
 //       $this->writer->write($data);
            foreach ($this->writers as $writer) {
                $writer->write($data);
            }
    }
}