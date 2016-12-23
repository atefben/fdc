<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

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
    use \Base\CoreBundle\Util\TranslationChanges;

    /**
     * @var integer
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     *
     */
    protected $firstColumn;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     *
     */
    protected $secondColumn;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     *
     */
    protected $thirdColumn;

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

}
