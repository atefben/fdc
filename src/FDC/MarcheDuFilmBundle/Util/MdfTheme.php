<?php

namespace FDC\MarcheDuFilmBundle\Util;

trait MdfTheme
{
    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $theme = self::THEME_PRODUCERS_WORKSHOP;

    /**
     * getThemes function.
     *
     * @access public
     * @static
     */
    public static function getThemes()
    {
        return array(
            '' => '',
            self::THEME_PRODUCERS_WORKSHOP => 'form.mdf.theme.producers_workshop',
            self::THEME_PRODUCERS_NETWORK => 'form.mdf.theme.producers_network',
            self::THEME_DOC_CORNER => 'form.mdf.theme.doc_corner',
            self::THEME_NEXT => 'form.mdf.theme.next',
            self::THEME_MIXERS => 'form.mdf.theme.mixers',
            self::THEME_GOES_TO_CANNES => 'form.mdf.theme.goes_to_cannes'
        );
    }

    /**
     * @param $theme
     * @return $this
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getTheme()
    {
        return $this->theme;
    }
}
