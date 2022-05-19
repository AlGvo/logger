<?php

namespace Logger;

use Logger\Writer\WriterInterface;
use Psr\Log\AbstractLogger;

/**
 * Класс имплементация интерфейса @link AbstractLogger psr стандарта
 *
 * Данный класс реализует логирование информации
 * @author AlGvo <dp161185gav@gmail,com>
 * @version 1.0
 * @package Logger
 */
class Logger extends AbstractLogger
{
    /** @var $writers WriterInterface[] */
    private array $writers;

    /**
     * Конструктор класса
     * @param array $writers
     * @access public
     */
    public function __construct(array $writers)
    {
        $this->writers = $writers;
    }

    /**
     * Метод логирования переданной информации
     * @param $level
     * @param $message
     * @param array $context
     * @return void
     * @access public
     */
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
            foreach ($this->writers as $writer) {
                $writer->write($data);
            }
    }
}