<?php

namespace Base\CoreBundle\Util;

use \DateTime;


/**
 * Seo trait.
 *
 * @author  Antoine Mineau
 * \@company Ohwee
 */
trait Seo
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $seoTitle;

    /**
     * @var text
     *
     * @ORM\Column(type="text", nullable=true)
     **/
    private $seoDescription;

    /**
     * @var Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    private $seoFile;

    /**
     * Set seoTitle
     *
     * @param string $seoTitle
     * @return NewsImageTranslation
     */
    public function setSeoTitle($seoTitle)
    {
        $this->seoTitle = $seoTitle;

        return $this;
    }

    /**
     * Get seoTitle
     *
     * @return string
     */
    public function getSeoTitle()
    {
        return $this->seoTitle;
    }

    /**
     * Set seoDescription
     *
     * @param string $seoDescription
     * @return NewsImageTranslation
     */
    public function setSeoDescription($seoDescription)
    {
        $this->seoDescription = $seoDescription;

        return $this;
    }

    /**
     * Get seoDescription
     *
     * @return string
     */
    public function getSeoDescription()
    {
        return $this->seoDescription;
    }


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