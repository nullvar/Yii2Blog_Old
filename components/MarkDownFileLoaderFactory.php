<?php

namespace app\components;

use app\models\MarkDownFile;

/**
 * @author Anton Karamnov
 */
class MarkDownFileLoaderFactory
{
    /**
     * @return \app\helpers\FileLoader
     */
    public static function build()
    {
        return new FileLoader(new MarkDownFile);
    }
}