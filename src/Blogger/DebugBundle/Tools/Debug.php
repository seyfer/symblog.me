<?php

namespace Blogger\DebugBundle\Tools;

use Doctrine\Common\Util\Debug as DoctrineDebug;

/**
 * Description of Debug
 *
 * @author seyfer
 */
class Debug
{

    public static function dump($var, $maxDepth = 2, $stripTags = true)
    {
        ob_start();
        DoctrineDebug::dump($var, $maxDepth, $stripTags);
        $dump = ob_get_clean();

        echo '<pre>';
        echo $dump;
        echo '</pre>';
    }

}
