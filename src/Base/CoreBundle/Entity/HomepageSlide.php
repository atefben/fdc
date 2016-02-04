<?php
namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use Symfony\Component\Validator\Constraints as Assert;

/**
* HomepageSlide
*
* @ORM\Table()
* @ORM\Entity
* @ORM\HasLifecycleCallbacks()
*/
class HomepageSlide extends Homepage
{
    use Translatable;

    /**
     * @ORM\OneToMany(targetEntity="NewsNewsAssociated", mappedBy="news", cascade={"persist"})
     *
     * @Groups({"news_list", "news_show"})
     */
    private $news;

    /**
     * @var MediaImage
     *
     * @ORM\ManyToOne(targetEntity="MediaImage")
     *
     * @Groups({"news_list", "news_show"})
     * @Assert\NotNull()
     */
    private $image;


    /**
     * @ORM\OneToMany(targetEntity="Statement", mappedBy="festival")
     */
    private $statements;


    /**
     * Add news
     *
     * @param \Base\CoreBundle\Entity\NewsNewsAssociated $news
     * @return HomepageSlide
     */
    public function addNews(\Base\CoreBundle\Entity\NewsNewsAssociated $news)
    {
        $this->news[] = $news;

        return $this;
    }

    /**
     * Remove news
     *
     * @param \Base\CoreBundle\Entity\NewsNewsAssociated $news
     */
    public function removeNews(\Base\CoreBundle\Entity\NewsNewsAssociated $news)
    {
        $this->news->removeElement($news);
    }

    /**
     * Get news
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Set image
     *
     * @param \Base\CoreBundle\Entity\MediaImage $image
     * @return HomepageSlide
     */
    public function setImage(\Base\CoreBundle\Entity\MediaImage $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Base\CoreBundle\Entity\MediaImage 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add statements
     *
     * @param \Base\CoreBundle\Entity\Statement $statements
     * @return HomepageSlide
     */
    public function addStatement(\Base\CoreBundle\Entity\Statement $statements)
    {
        $this->statements[] = $statements;

        return $this;
    }

    /**
     * Remove statements
     *
     * @param \Base\CoreBundle\Entity\Statement $statements
     */
    public function removeStatement(\Base\CoreBundle\Entity\Statement $statements)
    {
        $this->statements->removeElement($statements);
    }

    /**
     * Get statements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStatements()
    {
        return $this->statements;
    }
}
