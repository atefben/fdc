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
 * HomepageCorporateTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class HomepageCorporateTranslation implements TranslateChildInterface
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
    private $popinSubtitle1;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $popinSubtitle2;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $bannerText;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $pushEditionTitle;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $pushEditionUrl;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $pushMainTitle1;
    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $pushMainSubtitle1;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $pushMainUrl1;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $pushMainTitle2;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $pushMainSubtitle2;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $pushMainUrl2;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $pushSecondaryTitle1;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $pushSecondaryUrl1;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $pushSecondaryTitle2;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $pushSecondaryUrl2;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $pushSecondaryTitle3;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $pushSecondaryUrl3;


    /**
     * Set popinSubtitle1
     *
     * @param string $popinSubtitle1
     * @return HomepageCorporateTranslation
     */
    public function setPopinSubtitle1($popinSubtitle1)
    {
        $this->popinSubtitle1 = $popinSubtitle1;

        return $this;
    }

    /**
     * Get popinSubtitle1
     *
     * @return string
     */
    public function getPopinSubtitle1()
    {
        return $this->popinSubtitle1;
    }

    /**
     * Set popinSubtitle2
     *
     * @param string $popinSubtitle2
     * @return HomepageCorporateTranslation
     */
    public function setPopinSubtitle2($popinSubtitle2)
    {
        $this->popinSubtitle2 = $popinSubtitle2;

        return $this;
    }

    /**
     * Get popinSubtitle2
     *
     * @return string
     */
    public function getPopinSubtitle2()
    {
        return $this->popinSubtitle2;
    }

    /**
     * Set bannerText
     *
     * @param string $bannerText
     * @return HomepageCorporateTranslation
     */
    public function setBannerText($bannerText)
    {
        $this->bannerText = $bannerText;

        return $this;
    }

    /**
     * Get bannerText
     *
     * @return string
     */
    public function getBannerText()
    {
        return $this->bannerText;
    }

    /**
     * Set pushEditionTitle
     *
     * @param string $pushEditionTitle
     * @return HomepageCorporateTranslation
     */
    public function setPushEditionTitle($pushEditionTitle)
    {
        $this->pushEditionTitle = $pushEditionTitle;

        return $this;
    }

    /**
     * Get pushEditionTitle
     *
     * @return string
     */
    public function getPushEditionTitle()
    {
        return $this->pushEditionTitle;
    }

    /**
     * Set pushMainTitle1
     *
     * @param string $pushMainTitle1
     * @return HomepageCorporateTranslation
     */
    public function setPushMainTitle1($pushMainTitle1)
    {
        $this->pushMainTitle1 = $pushMainTitle1;

        return $this;
    }

    /**
     * Get pushMainTitle1
     *
     * @return string
     */
    public function getPushMainTitle1()
    {
        return $this->pushMainTitle1;
    }

    /**
     * Set pushMainTitle2
     *
     * @param string $pushMainTitle2
     * @return HomepageCorporateTranslation
     */
    public function setPushMainTitle2($pushMainTitle2)
    {
        $this->pushMainTitle2 = $pushMainTitle2;

        return $this;
    }

    /**
     * Get pushMainTitle2
     *
     * @return string
     */
    public function getPushMainTitle2()
    {
        return $this->pushMainTitle2;
    }

    /**
     * Set pushSecondaryTitle1
     *
     * @param string $pushSecondaryTitle1
     * @return HomepageCorporateTranslation
     */
    public function setPushSecondaryTitle1($pushSecondaryTitle1)
    {
        $this->pushSecondaryTitle1 = $pushSecondaryTitle1;

        return $this;
    }

    /**
     * Get pushSecondaryTitle1
     *
     * @return string
     */
    public function getPushSecondaryTitle1()
    {
        return $this->pushSecondaryTitle1;
    }

    /**
     * Set pushSecondaryTitle2
     *
     * @param string $pushSecondaryTitle2
     * @return HomepageCorporateTranslation
     */
    public function setPushSecondaryTitle2($pushSecondaryTitle2)
    {
        $this->pushSecondaryTitle2 = $pushSecondaryTitle2;

        return $this;
    }

    /**
     * Get pushSecondaryTitle2
     *
     * @return string
     */
    public function getPushSecondaryTitle2()
    {
        return $this->pushSecondaryTitle2;
    }

    /**
     * Set pushSecondaryTitle3
     *
     * @param string $pushSecondaryTitle3
     * @return HomepageCorporateTranslation
     */
    public function setPushSecondaryTitle3($pushSecondaryTitle3)
    {
        $this->pushSecondaryTitle3 = $pushSecondaryTitle3;

        return $this;
    }

    /**
     * Get pushSecondaryTitle3
     *
     * @return string
     */
    public function getPushSecondaryTitle3()
    {
        return $this->pushSecondaryTitle3;
    }

    /**
     * Set pushMainUrl1
     *
     * @param string $pushMainUrl1
     * @return HomepageCorporateTranslation
     */
    public function setPushMainUrl1($pushMainUrl1)
    {
        $this->pushMainUrl1 = $pushMainUrl1;

        return $this;
    }

    /**
     * Get pushMainUrl1
     *
     * @return string
     */
    public function getPushMainUrl1()
    {
        return $this->pushMainUrl1;
    }

    /**
     * Set pushMainUrl2
     *
     * @param string $pushMainUrl2
     * @return HomepageCorporateTranslation
     */
    public function setPushMainUrl2($pushMainUrl2)
    {
        $this->pushMainUrl2 = $pushMainUrl2;

        return $this;
    }

    /**
     * Get pushMainUrl2
     *
     * @return string
     */
    public function getPushMainUrl2()
    {
        return $this->pushMainUrl2;
    }

    /**
     * Set pushSecondaryUrl1
     *
     * @param string $pushSecondaryUrl1
     * @return HomepageCorporateTranslation
     */
    public function setPushSecondaryUrl1($pushSecondaryUrl1)
    {
        $this->pushSecondaryUrl1 = $pushSecondaryUrl1;

        return $this;
    }

    /**
     * Get pushSecondaryUrl1
     *
     * @return string
     */
    public function getPushSecondaryUrl1()
    {
        return $this->pushSecondaryUrl1;
    }

    /**
     * Set pushSecondaryUrl2
     *
     * @param string $pushSecondaryUrl2
     * @return HomepageCorporateTranslation
     */
    public function setPushSecondaryUrl2($pushSecondaryUrl2)
    {
        $this->pushSecondaryUrl2 = $pushSecondaryUrl2;

        return $this;
    }

    /**
     * Get pushSecondaryUrl2
     *
     * @return string
     */
    public function getPushSecondaryUrl2()
    {
        return $this->pushSecondaryUrl2;
    }

    /**
     * Set pushSecondaryUrl3
     *
     * @param string $pushSecondaryUrl3
     * @return HomepageCorporateTranslation
     */
    public function setPushSecondaryUrl3($pushSecondaryUrl3)
    {
        $this->pushSecondaryUrl3 = $pushSecondaryUrl3;

        return $this;
    }

    /**
     * Get pushSecondaryUrl3
     *
     * @return string
     */
    public function getPushSecondaryUrl3()
    {
        return $this->pushSecondaryUrl3;
    }

    /**
     * Set pushEditionUrl
     *
     * @param string $pushEditionUrl
     * @return HomepageCorporateTranslation
     */
    public function setPushEditionUrl($pushEditionUrl)
    {
        $this->pushEditionUrl = $pushEditionUrl;

        return $this;
    }

    /**
     * Get pushEditionUrl
     *
     * @return string
     */
    public function getPushEditionUrl()
    {
        return $this->pushEditionUrl;
    }

    /**
     * Set pushMainSubtitle1
     *
     * @param string $pushMainSubtitle1
     * @return HomepageCorporateTranslation
     */
    public function setPushMainSubtitle1($pushMainSubtitle1)
    {
        $this->pushMainSubtitle1 = $pushMainSubtitle1;

        return $this;
    }

    /**
     * Get pushMainSubtitle1
     *
     * @return string
     */
    public function getPushMainSubtitle1()
    {
        return $this->pushMainSubtitle1;
    }

    /**
     * Set pushMainSubtitle2
     *
     * @param string $pushMainSubtitle2
     * @return HomepageCorporateTranslation
     */
    public function setPushMainSubtitle2($pushMainSubtitle2)
    {
        $this->pushMainSubtitle2 = $pushMainSubtitle2;

        return $this;
    }

    /**
     * Get pushMainSubtitle2
     *
     * @return string
     */
    public function getPushMainSubtitle2()
    {
        return $this->pushMainSubtitle2;
    }
}
