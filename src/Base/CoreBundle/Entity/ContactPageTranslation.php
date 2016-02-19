<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Util\Seo;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateChild;

use Doctrine\ORM\Mapping as ORM;
/**
 * ContactPageTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class ContactPageTranslation implements TranslateChildInterface
{
    use Time;
    use TranslateChild;
    use Translation;
    use Seo;

    /**
     * @var integer
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     *
     */
    private $firstColumn;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     *
     */
    private $secondColumn;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     *
     */
    private $thirdColumn;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     *
     */
    private $fourthColumn;


    /**
     * Set title
     *
     * @param string $title
     * @return ContactPageTranslation
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set firstColumn
     *
     * @param string $firstColumn
     * @return ContactPageTranslation
     */
    public function setFirstColumn($firstColumn)
    {
        $this->firstColumn = $firstColumn;

        return $this;
    }

    /**
     * Get firstColumn
     *
     * @return string 
     */
    public function getFirstColumn()
    {
        return $this->firstColumn;
    }

    /**
     * Set secondColumn
     *
     * @param string $secondColumn
     * @return ContactPageTranslation
     */
    public function setSecondColumn($secondColumn)
    {
        $this->secondColumn = $secondColumn;

        return $this;
    }

    /**
     * Get secondColumn
     *
     * @return string 
     */
    public function getSecondColumn()
    {
        return $this->secondColumn;
    }

    /**
     * Set thirdColumn
     *
     * @param string $thirdColumn
     * @return ContactPageTranslation
     */
    public function setThirdColumn($thirdColumn)
    {
        $this->thirdColumn = $thirdColumn;

        return $this;
    }

    /**
     * Get thirdColumn
     *
     * @return string 
     */
    public function getThirdColumn()
    {
        return $this->thirdColumn;
    }

    /**
     * Set fourthColumn
     *
     * @param string $fourthColumn
     * @return ContactPageTranslation
     */
    public function setFourthColumn($fourthColumn)
    {
        $this->fourthColumn = $fourthColumn;

        return $this;
    }

    /**
     * Get fourthColumn
     *
     * @return string 
     */
    public function getFourthColumn()
    {
        return $this->fourthColumn;
    }
}
