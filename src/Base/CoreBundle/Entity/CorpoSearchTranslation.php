<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\TranslateChild;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Util\Seo;

use Base\CoreBundle\Util\Time;

/**
 * CorpoSearchTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CorpoSearchTranslation implements TranslateChildInterface
{
    use Seo;
    use Time;
    use Translation;
    use \Base\CoreBundle\Util\TranslationChanges;
    use TranslateChild;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $pushTitle1;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $pushTitle2;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $pushTitle3;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $pushUrl1;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $pushUrl2;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $pushUrl3;




    /**
     * Set pushTitle1
     *
     * @param string $pushTitle1
     * @return CorpoSearchTranslation
     */
    public function setPushTitle1($pushTitle1)
    {
        $this->pushTitle1 = $pushTitle1;

        return $this;
    }

    /**
     * Get pushTitle1
     *
     * @return string 
     */
    public function getPushTitle1()
    {
        return $this->pushTitle1;
    }

    /**
     * Set pushTitle2
     *
     * @param string $pushTitle2
     * @return CorpoSearchTranslation
     */
    public function setPushTitle2($pushTitle2)
    {
        $this->pushTitle2 = $pushTitle2;

        return $this;
    }

    /**
     * Get pushTitle2
     *
     * @return string 
     */
    public function getPushTitle2()
    {
        return $this->pushTitle2;
    }

    /**
     * Set pushTitle3
     *
     * @param string $pushTitle3
     * @return CorpoSearchTranslation
     */
    public function setPushTitle3($pushTitle3)
    {
        $this->pushTitle3 = $pushTitle3;

        return $this;
    }

    /**
     * Get pushTitle3
     *
     * @return string 
     */
    public function getPushTitle3()
    {
        return $this->pushTitle3;
    }

    /**
     * Set pushUrl1
     *
     * @param string $pushUrl1
     * @return CorpoSearchTranslation
     */
    public function setPushUrl1($pushUrl1)
    {
        $this->pushUrl1 = $pushUrl1;

        return $this;
    }

    /**
     * Get pushUrl1
     *
     * @return string 
     */
    public function getPushUrl1()
    {
        return $this->pushUrl1;
    }

    /**
     * Set pushUrl2
     *
     * @param string $pushUrl2
     * @return CorpoSearchTranslation
     */
    public function setPushUrl2($pushUrl2)
    {
        $this->pushUrl2 = $pushUrl2;

        return $this;
    }

    /**
     * Get pushUrl2
     *
     * @return string 
     */
    public function getPushUrl2()
    {
        return $this->pushUrl2;
    }

    /**
     * Set pushUrl3
     *
     * @param string $pushUrl3
     * @return CorpoSearchTranslation
     */
    public function setPushUrl3($pushUrl3)
    {
        $this->pushUrl3 = $pushUrl3;

        return $this;
    }

    /**
     * Get pushUrl3
     *
     * @return string 
     */
    public function getPushUrl3()
    {
        return $this->pushUrl3;
    }
}
