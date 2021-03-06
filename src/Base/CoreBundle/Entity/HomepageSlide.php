<?php
namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use Symfony\Component\Validator\Constraints as Assert;

/**
* HomepageSlide
*
* @ORM\Table()
* @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\HomepageSlideRepository")
* @ORM\HasLifecycleCallbacks()
*/
class HomepageSlide
{

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var News
     *
     * @ORM\ManyToOne(targetEntity="News")
     * @Groups("home")
     */
    protected $news;

    /**
     * @var Info
     *
     * @ORM\ManyToOne(targetEntity="Info")
     * @Groups("home")
     */
    protected $infos;

    /**
     * @var Info
     *
     * @ORM\ManyToOne(targetEntity="Statement")
     * @Groups("home")
     */
    protected $statement;

    /**
     * @var Homepage
     *
     * @ORM\ManyToOne(targetEntity="Homepage", inversedBy="homepageSlide")
     */
    protected $homepage;

    /**
     * @var position
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $position;
  

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
     * Set news
     *
     * @param \Base\CoreBundle\Entity\News $news
     * @return HomepageSlide
     */
    public function setNews(\Base\CoreBundle\Entity\News $news = null)
    {
        $this->news = $news;

        return $this;
    }

    /**
     * Get news
     *
     * @return \Base\CoreBundle\Entity\News 
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Set infos
     *
     * @param \Base\CoreBundle\Entity\Info $infos
     * @return HomepageSlide
     */
    public function setInfos(\Base\CoreBundle\Entity\Info $infos = null)
    {
        $this->infos = $infos;

        return $this;
    }

    /**
     * Get infos
     *
     * @return \Base\CoreBundle\Entity\Info 
     */
    public function getInfos()
    {
        return $this->infos;
    }

    /**
     * Set statement
     *
     * @param \Base\CoreBundle\Entity\Statement $statement
     * @return HomepageSlide
     */
    public function setStatement(\Base\CoreBundle\Entity\Statement $statement = null)
    {
        $this->statement = $statement;

        return $this;
    }

    /**
     * Get statement
     *
     * @return \Base\CoreBundle\Entity\Statement 
     */
    public function getStatement()
    {
        return $this->statement;
    }

    /**
     * Set homepage
     *
     * @param \Base\CoreBundle\Entity\Homepage $homepage
     * @return HomepageSlide
     */
    public function setHomepage(\Base\CoreBundle\Entity\Homepage $homepage = null)
    {
        $this->homepage = $homepage;

        return $this;
    }

    /**
     * Get homepage
     *
     * @return \Base\CoreBundle\Entity\Homepage 
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return HomepageSlide
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }
}
