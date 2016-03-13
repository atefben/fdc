<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\Seo;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateChild;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

use JMS\Serializer\Annotation\Groups;

/**
 * FDCPageWebTvLiveTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FDCPageWebTvLiveTranslation implements TranslateChildInterface
{
    use Time;
    use Translation;
    use TranslateChild;
    use Seo;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Groups({
     *     "web_tv_list",
     *     "web_tv_show"
     * })
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({
     *     "web_tv_list",
     *     "web_tv_show"
     * })
     */
    private $firstSubHead;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({
     *     "web_tv_list",
     *     "web_tv_show"
     * })
     */
    private $secondSubHead;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     * @Groups({
     *     "web_tv_list",
     *     "web_tv_show"
     * })
     */
    private $directUrl;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     * @Groups({
     *     "web_tv_list",
     *     "web_tv_show"
     * })
     */
    private $teaserUrl;


    /**
     * Set title
     *
     * @param string $title
     * @return FDCPageWebTvLiveTranslation
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
     * Set firstSubHead
     *
     * @param string $firstSubHead
     * @return FDCPageWebTvLiveTranslation
     */
    public function setFirstSubHead($firstSubHead)
    {
        $this->firstSubHead = $firstSubHead;

        return $this;
    }

    /**
     * Get firstSubHead
     *
     * @return string 
     */
    public function getFirstSubHead()
    {
        return $this->firstSubHead;
    }

    /**
     * Set secondSubHead
     *
     * @param string $secondSubHead
     * @return FDCPageWebTvLiveTranslation
     */
    public function setSecondSubHead($secondSubHead)
    {
        $this->secondSubHead = $secondSubHead;

        return $this;
    }

    /**
     * Get secondSubHead
     *
     * @return string 
     */
    public function getSecondSubHead()
    {
        return $this->secondSubHead;
    }

    /**
     * Set directUrl
     *
     * @param string $directUrl
     * @return FDCPageWebTvLiveTranslation
     */
    public function setDirectUrl($directUrl)
    {
        $this->directUrl = $directUrl;

        return $this;
    }

    /**
     * Get directUrl
     *
     * @return string 
     */
    public function getDirectUrl()
    {
        return $this->directUrl;
    }

    /**
     * Set teaserUrl
     *
     * @param string $teaserUrl
     * @return FDCPageWebTvLiveTranslation
     */
    public function setTeaserUrl($teaserUrl)
    {
        $this->teaserUrl = $teaserUrl;

        return $this;
    }

    /**
     * Get teaserUrl
     *
     * @return string 
     */
    public function getTeaserUrl()
    {
        return $this->teaserUrl;
    }
}
