<?php

namespace App\Core\Support\Traits;

use App\Core\Support\BaseException;

trait ErrorTrait
{
    /**
     * @param BaseException $e
     * @return array
     */
    protected function errorFromException(BaseException $e)
    {
        return [
            'error' => $e->getMessage(),
            'trace' => $e->getTrace()
        ];
    }
}
