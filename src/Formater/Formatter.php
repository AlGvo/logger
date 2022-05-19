<?php

namespace Logger\Formater;

/**
 * Класс имплементация интерфейса FormatterInterface
 * @author AlGvo <dp161185gav@gmail,com>
 * @version 1.0
 * @package Logger
 */
class Formatter implements FormatterInterface
{
    /**
     * Основная цель форматировать строку @link $format в формат переденный в масиве @link $data
     * @param string $format Данные форматирования
     * @param array $data Шаблон форматирования
     * @return array|string|string[]
     * @access public
     */
    public function format(string $format, array $data)
    {
        if (empty($data['context'])) {
            $format = str_replace('{context}', '', $format);
        }
        foreach ($data as $key => $item) {
            if (is_array($item)) {
                $item = json_encode($item);
            }
            $format = str_replace('{'.$key.'}', $item, $format);
        }

        return $format;
    }
}