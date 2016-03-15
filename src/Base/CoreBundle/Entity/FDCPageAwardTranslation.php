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
}
