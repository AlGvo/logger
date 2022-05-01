<?php

namespace Logger\Writer;

use SQLite3;

class DbWriter implements WriterInterface
{

    const DB_PATH = __DIR__.'/../../logger.sqlite';
    private SQLite3 $db;

    public function __construct()
    {
        $this->db = new SQLite3(self::DB_PATH);
    }

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