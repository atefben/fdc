<?php

namespace Base\CoreBundle\Util;

trait TranslationChanges
{

    /**
     * @var boolean
     */
    private $applyChanges = true;

    /**
     * @return boolean
     */
    public function isApplyChanges()
    {
        return $this->applyChanges;
    }

    /**
     * @param boolean $applyChanges
     * @return TranslationChanges
     */
    public function setApplyChanges($applyChanges)
    {
        $this->applyChanges = $applyChanges;
        return $this;
    }

}