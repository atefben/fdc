<?php
namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * HomepageCorporateSlide
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\HomepageCorporateSlideRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class HomepageCorporateSlide
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
     * @var Info
     *
     * @ORM\ManyToOne(targetEntity="Info")
     */
    protected $info;

    /**
     * @var Info
     *
     * @ORM\ManyToOne(targetEntity="Statement")
     */
    protected $statement;

    /**
     * @var HomepageCorporate
     *
     * @ORM\ManyToOne(targetEntity="HomepageCorporate")
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
     * Set info
     *
     * @param \Base\CoreBundle\Entity\Info $info
     * @return HomepageCorporateSlide
     */
    public function setInfo(\Base\CoreBundle\Entity\Info $info = null)
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Get info
     *
     * @return \Base\CoreBundle\Entity\Info
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Set statement
     *
     * @param \Base\CoreBundle\Entity\Statement $statement
     * @return HomepageCorporateSlide
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
     * @param \Base\CoreBundle\Entity\HomepageCorporate $homepage
     * @return HomepageCorporateSlide
     */
    public function setHomepage(\Base\CoreBundle\Entity\HomepageCorporate $homepage = null)
    {
        $this->homepage = $homepage;

        return $this;
    }

    /**
     * Get homepage
     *
     * @return \Base\CoreBundle\Entity\HomepageCorporate
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return HomepageCorporateSlide
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
