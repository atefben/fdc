<?php

namespace Base\CoreBundle\Entity;


use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\Seo;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateChild;
use Doctrine\ORM\Mapping as ORM;

use Gedmo\Mapping\Annotation as Gedmo;

/**
 * FDCPageAwardTranslation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\FDCPageAwardTranslationRepository")
 * @ORM\HasLifecycleCallbacks
 */
class FDCPageAwardTranslation implements TranslateChildInterface
{
    use Time;
    use Translation;
    use TranslateChild;
    use Seo;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     *
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $nameLongsMetrages;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $nameCourtsMetrages;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $nameEnCompetition;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $header;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(name="slug", type="string", length=255, unique=false, nullable=true)
     */
    private $slug;


    /**
     * Set name
     *
     * @param string $name
     * @return FDCPageAwardTranslation
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return FDCPageAwardTranslation
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set nameLongsMetrages
     *
     * @param string $nameLongsMetrages
     * @return FDCPageAwardTranslation
     */
    public function setNameLongsMetrages($nameLongsMetrages)
    {
        $this->nameLongsMetrages = $nameLongsMetrages;

        return $this;
    }

    /**
     * Get nameLongsMetrages
     *
     * @return string 
     */
    public function getNameLongsMetrages()
    {
        return $this->nameLongsMetrages;
    }

    /**
     * Set nameCourtsMetrages
     *
     * @param string $nameCourtsMetrages
     * @return FDCPageAwardTranslation
     */
    public function setNameCourtsMetrages($nameCourtsMetrages)
    {
        $this->nameCourtsMetrages = $nameCourtsMetrages;

        return $this;
    }

    /**
     * Get nameCourtsMetrages
     *
     * @return string 
     */
    public function getNameCourtsMetrages()
    {
        return $this->nameCourtsMetrages;
    }

    /**
     * Set nameEnCompetition
     *
     * @param string $nameEnCompetition
     * @return FDCPageAwardTranslation
     */
    public function setNameEnCompetition($nameEnCompetition)
    {
        $this->nameEnCompetition = $nameEnCompetition;

        return $this;
    }

    /**
     * Get nameEnCompetition
     *
     * @return string 
     */
    public function getNameEnCompetition()
    {
        return $this->nameEnCompetition;
    }

    /**
     * Set header
     *
     * @param string $header
     * @return FDCPageAwardTranslation
     */
    public function setHeader($header)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Get header
     *
     * @return string 
     */
    public function getHeader()
    {
        return $this->header;
    }
}
