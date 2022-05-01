<?php

namespace Logger\Formater;

class Formatter implements FormatterInterface
{

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