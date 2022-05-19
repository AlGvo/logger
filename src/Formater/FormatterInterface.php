<?php

namespace Logger\Formater;

 /**
 * Интерфейс, для всех методов форматирования
 * @author AlGvo <dp161185gav@gmail,com>
 * @version 1.0
 * @package Logger
 */
interface FormatterInterface
{
    /**
     * Метод для форматирования стринги по шаблону переданному в массиве
     * @param string $format Данные для форматирования
     * @param array $data Шаблон форматирования
     * @return mixed
     * @access public
     */
    public function format(string $format, array $data);
}