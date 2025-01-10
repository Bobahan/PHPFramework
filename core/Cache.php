<?php

namespace PHPFramework;

class Cache
{
    public function set($key, $data, $seconds = 3600)
    {
        // текущая метка времени если меньше или равна end_time то кэш актуален
        // если нет то кэш просрочен, билинни дата улахан буоллагына чем было установлен то срок стек

        $content['data'] = $data;
        $content['end_time'] = time() + $seconds; // текущее время + 1 час 

        $cache_file = CACHE . '/' . md5($key) . '.txt';

        // данные кладем в файл
        // данные приводим к строке с помощью serialize
        file_put_contents($cache_file, serialize($content));
    }

    public function get($key, $default = null)
    {
        $cache_file = CACHE . '/' . md5($key) . '.txt';

        if(file_exists($cache_file)) {
            // достаем десериализованные данные из файла 
            $content = unserialize(file_get_contents($cache_file));

            // если текущее время меньше чем значение end_time, тогда данные достаем из кэша
            if(time() <= $content['end_time']) {
                return $content['data'];
            }

            // данные просрочены удаляем файл
            unlink($cache_file);
        }

        return $default;
    }

    public function remove($key)
    {
        $cache_file = CACHE . '/' . md5($key) . '.txt';

        if(file_exists($cache_file)) {
            unlink($cache_file);
        }
    }
}