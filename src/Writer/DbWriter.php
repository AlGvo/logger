<?php

namespace Logger\Writer;

use SQLite3;

/**
 * Класс имплементация интерфейса WriterInterface
 *
 * Данный класс реализует логирование информации в базу данный
 * @author AlGvo <dp161185gav@gmail,com>
 * @version 1.0
 * @package Logger
 */
class DbWriter implements WriterInterface
{
    /**
     * Константа пути к базе данных куда логируется информация
     *
     */
    const DB_PATH = __DIR__.'/../../../../../logger.sqlite';

    /**
     * Тип базы данных который используется для логирования
     * @var SQLite3
     * @access private
     */
    private SQLite3 $db;

    /**
     * Конструктор данного класса
     * @access public
     */
    public function __construct()
    {
        $this->db = new SQLite3(self::DB_PATH);
    }

    /**
     * Метод создания таблицы базы данных
     * @return void
     * @access public
     */
    public function createTable()
    {
        $this->db->query('CREATE TABLE IF NOT EXISTS logs (
        	id INTEGER PRIMARY KEY,
	        `level` TEXT NOT NULL,
	        message TEXT NOT NULL,
	        context TEXT,
	        created_at TIMESTAMP NOT NULL
            );'
        );
    }

    /**
     * Метод записи в базу данных
     * @param array $data информация которая записывается в базу данных
     * @return mixed|void
     */
    public function write(array $data)
    {
        $context = null;
        if (isset($data['context'])) {
            $context = json_encode($data['context']);
        }
        $this->db->query("INSERT INTO logs (`level`, message, context, created_at) 
                                VALUES( '{$data['level']}','{$data['message']}','{$context}', '{$data['date']}');
        ");
    }
}