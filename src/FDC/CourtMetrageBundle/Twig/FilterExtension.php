<?php

namespace FDC\CourtMetrageBundle\Twig;

class FilterExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('shorten', array($this, 'shorten')),
            new \Twig_SimpleFilter('shortenWithHtml', array($this, 'shortenWithHtml')),
        );
    }

    /**
     * Replaces strings end with the given characters($end)
     *
     * @param $string
     * @param $maxLength
     * @param $end
     * @return string
     */
    public function shorten($string, $maxLength, $end = '...')
    {
        if (strlen($string) > $maxLength) {
            $text = substr($string, 0, $maxLength - strlen($end));
            
            return $text . $end;
        }

        return $string;
    }

    /**
     * @param $string
     * @param $maxLength
     * @param string $end
     * @param $startTag
     * @param $endTag
     * @return string
     */
    public function shortenWithHtml($string, $maxLength, $end = '...', $startTag, $endTag)
    {
        $stringLength = strlen(str_replace([$startTag, $endTag], '', $string));

        if ($stringLength > $maxLength) {
            $diff = $stringLength - $maxLength;
            $explode = explode($endTag . $startTag, $string);

            $count = count($explode);
            for ($i = 1; $i < $count; $i++) {
                if (strlen($explode[$count - $i]) - strlen($endTag) > $diff) {
                    $explode[$count - $i] = substr($explode[$count - $i], 0, -1 * strlen($end . $endTag . $diff)) . $end . $endTag;
                    break;
                } else if (isset($explode[$count - ($i + 1)])) {
                    $explode[$count - ($i + 1)] .= $endTag;
                    $diff -= (strlen($explode[$count - $i]) - strlen($endTag));
                    unset($explode[$count - $i]);
                }
            }


            $text = implode($endTag . $startTag, $explode);

            return $text;
        }

        return $string;
    }

    public function getName()
    {
        return 'filter_extension';
    }
}