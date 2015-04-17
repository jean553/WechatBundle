<?php

namespace jean553\WechatBundle\Traits;

trait StringUtilsTrait
{
    /**
     * Get the string between two given strings
     *
     * @param string $fullString contains the string to analyze
     * @param string $start contains the left sided string
     * @param string $end contains the right sided string
     *
     * @return string|null extracted string, null if error
     */
    private function getSubString(
        $fullString,
        $start,
        $end
    ) {
        // cancel the functin if the
        // initial string does not exist
        $ini = (int) strpos($fullString, $start);
        if ($ini === 0) {
            return null;
        }

        // catch the required string
        $ini += strlen($start);
        $len = strpos($fullString, $end, $ini) - $ini;

        return substr($fullString, $ini, $len);
    }
}
