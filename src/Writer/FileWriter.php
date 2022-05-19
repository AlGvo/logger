<?php

namespace Logger\Writer;

use Logger\Formater\FormatterInterface;

/**
 * Класс имплементация интерфейса WriterInterface
 *
 * Данный класс реализует логирование информации в определенном формате в файл
 * @author AlGvo <dp161185gav@gmail,com>
 * @version 1.0
 * @package Logger
 */
class FileWriter implements WriterInterface
{
    /**
     * Путь директории где лежит фойл где собирается лог
     * @var string
     * @access private
     */
    private string $dir = __DIR__.'/../log/';

    /**
     * Имя файла логирования
     * @var string
     * @access private
     */
    private string $defaultFile = 'logger';

    /**
     * Расширение файла логирования
     * @var string
     * @access private
     */
    private string $extends = '.log';

    /**
     * Интерфейс Класса форматирования
     * @var FormatterInterface
     * @access private
     */
    private FormatterInterface $formatter;

    /**
     * Формат записи логи
     * @var string
     * @access private
     */
    public string $format = '{date} {level} {message} {context}';

    /**
     * Конструктор класса
     * @param FormatterInterface $formatter
     * @access public
     */
    public function __construct(FormatterInterface $formatter)
    {
        $this->formatter = $formatter;
    }

    /**
     * Метод записи в файл
     * @param array $data
     * @return mixed|void
     * @access public
     */
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