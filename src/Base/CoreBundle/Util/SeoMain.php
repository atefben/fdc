<?php

namespace Base\CoreBundle\Util;


/**
 * SeoMain trait.
 *
 * @author  Antoine Mineau
 * \@company Ohwee
 */
trait SeoMain
{

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}))
     */
    private $seoFile;


    /**
     * Set seoFile
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $seoFile
     * @return $this
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