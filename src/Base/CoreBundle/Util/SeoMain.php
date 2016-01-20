<?php

namespace Base\CoreBundle\Util;

use \DateTime;


/**
 * SeoMain trait.
 *
 * @author  Antoine Mineau
 * \@company Ohwee
 */
trait SeoMain
{

    /**
     * @var Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    private $seoFile;


    /**
     * Set seoFile
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $seoFile
     * @return News
     */
    public function setSeoFile(\Application\Sonata\MediaBundle\Entity\Media $seoFile = null)
    {
        $this->seoFile = $seoFile;

        return $this;
    }

    /**
     * Get seoFile
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getSeoFile()
    {
        return $this->seoFile;
    }
}