<?php

namespace FDC\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Application\Sonata\MediaBundle\Entity\Media;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ArticleVideo
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
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="videos")
     */
    protected $article;
    

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
     * @return ArticleVideo
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
}
