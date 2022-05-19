<?php

namespace Logger\Writer;

/**
 * Интерфейс, для всех методов записи лога
 * @author AlGvo <dp161185gav@gmail,com>
 * @version 1.0
 * @package Logger
 */
interface WriterInterface
{
    /**
     * @param array $data Массив данніх которые нужно сохранить
     * @return mixed
     * @access public
     */
    public function write(array $data);
}