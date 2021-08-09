<?php

namespace App\Helpers;

class PaginateHelper
{
    /**
     * @param $data
     * @param array $params
     * @return mixed
     */
    public static function paginateWithParams($data, array $params = [])
    {
        foreach ($params as $title => $value) {
            $data->appends([$title => $value]);
        }

        return $data->links();
    }
}
