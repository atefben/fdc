<?php

namespace FDC\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ArticleAudio
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var Article
     *
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="audios")
     */
    protected $article;
    
    /**
     * @var Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", inversedBy="articleAudios")
     */
    protected $audio;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set article
     *
     * @param \FDC\CoreBundle\Entity\Article $article
     * @return ArticleAudio
     */
    public function setArticle(\FDC\CoreBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \FDC\CoreBundle\Entity\Article 
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set audio
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $audio
     * @return ArticleAudio
     */
    public function setAudio(\Application\Sonata\MediaBundle\Entity\Media $audio = null)
    {
        $this->audio = $audio;

        return $this;
    }

    /**
     * Get audio
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getAudio()
    {
        return $this->audio;
    }
}
