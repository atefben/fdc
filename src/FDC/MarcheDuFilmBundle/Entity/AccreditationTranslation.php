<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\TranslateChild;
use FDC\MarcheDuFilmBundle\Interfaces\MdfStateInterface;
use FDC\MarcheDuFilmBundle\Util\MdfState;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * AccreditationTranslation
 * @ORM\Table(name="mdf_accreditation_translation")
 * @ORM\Entity
 */
class AccreditationTranslation implements MdfStateInterface, TranslateChildInterface
{
    use Translation;
    use MdfState;
    use TranslationChanges;
    use TranslateChild;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $subtitle;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $activeUrl;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $promotionsTitle;

    /**
     * @var string
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isEarlyBird = false;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $promotionTitle1;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $promotionPrice1;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $promotionInformation1;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    protected $promotionState1 = self::STATE_INACTIVE;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $promotionTitle2;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $promotionPrice2;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $promotionInformation2;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    protected $promotionState2 = self::STATE_INACTIVE;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $promotionTitle3;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $promotionPrice3;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $promotionInformation3;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    protected $promotionState3 = self::STATE_INACTIVE;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $promotionDetailsTitle1;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Length(
     *      min = 1,
     *      max = 1
     * )
     */
    protected $promotionDetailsPricePrefix1;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $promotionDetailsPrice1;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $promotionDetailsPriceSuffix1;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $promotionDetailsInformation1;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $promotionDetailsTitle2;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Length(
     *      min = 1,
     *      max = 1
     * )
     */
    protected $promotionDetailsPricePrefix2;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $promotionDetailsPrice2;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $promotionDetailsPriceSuffix2;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $promotionDetailsInformation2;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $promotionDetailsTitle3;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Length(
     *      min = 1,
     *      max = 1
     * )
     */
    protected $promotionDetailsPricePrefix3;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $promotionDetailsPrice3;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $promotionDetailsPriceSuffix3;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $promotionDetailsInformation3;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * @param $subtitle
     *
     * @return $this
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }


    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getActiveUrl()
    {
        return $this->activeUrl;
    }

    /**
     * @param $activeUrl
     *
     * @return $this
     */
    public function setActiveUrl($activeUrl)
    {
        $this->activeUrl = $activeUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getPromotionsTitle()
    {
        return $this->promotionsTitle;
    }

    /**
     * @param $promotionsTitle
     *
     * @return $this
     */
    public function setPromotionsTitle($promotionsTitle)
    {
        $this->promotionsTitle = $promotionsTitle;

        return $this;
    }

    /**
     * @return string
     */
    public function getIsEarlyBird()
    {
        return $this->isEarlyBird;
    }

    /**
     * @param $isEarlyBird
     *
     * @return $this
     */
    public function setIsEarlyBird($isEarlyBird)
    {
        $this->isEarlyBird = $isEarlyBird;

        return $this;
    }

    /**
     * @return string
     */
    public function getPromotionTitle1()
    {
        return $this->promotionTitle1;
    }

    /**
     * @param $promotionTitle1
     *
     * @return $this
     */
    public function setPromotionTitle1($promotionTitle1)
    {
        $this->promotionTitle1 = $promotionTitle1;

        return $this;
    }

    /**
     * @return string
     */
    public function getPromotionPrice1()
    {
        return $this->promotionPrice1;
    }

    /**
     * @param $promotionPrice1
     *
     * @return $this
     */
    public function setPromotionPrice1($promotionPrice1)
    {
        $this->promotionPrice1 = $promotionPrice1;

        return $this;
    }

    /**
     * @return string
     */
    public function getPromotionInformation1()
    {
        return $this->promotionInformation1;
    }

    /**
     * @param $promotionInformation1
     *
     * @return $this
     */
    public function setPromotionInformation1($promotionInformation1)
    {
        $this->promotionInformation1 = $promotionInformation1;

        return $this;
    }

    /**
     * @return int
     */
    public function getPromotionState1()
    {
        return $this->promotionState1;
    }

    /**
     * @param $promotionState1
     *
     * @return $this
     */
    public function setPromotionState1($promotionState1)
    {
        $this->promotionState1 = $promotionState1;

        return $this;
    }

    /**
     * @return string
     */
    public function getPromotionTitle2()
    {
        return $this->promotionTitle2;
    }

    /**
     * @param $promotionTitle2
     *
     * @return $this
     */
    public function setPromotionTitle2($promotionTitle2)
    {
        $this->promotionTitle2 = $promotionTitle2;

        return $this;
    }

    /**
     * @return string
     */
    public function getPromotionPrice2()
    {
        return $this->promotionPrice2;
    }

    /**
     * @param $promotionPrice2
     *
     * @return $this
     */
    public function setPromotionPrice2($promotionPrice2)
    {
        $this->promotionPrice2 = $promotionPrice2;

        return $this;
    }

    /**
     * @return string
     */
    public function getPromotionInformation2()
    {
        return $this->promotionInformation2;
    }

    /**
     * @param $promotionInformation2
     *
     * @return $this
     */
    public function setPromotionInformation2($promotionInformation2)
    {
        $this->promotionInformation2 = $promotionInformation2;

        return $this;
    }

    /**
     * @return int
     */
    public function getPromotionState2()
    {
        return $this->promotionState2;
    }

    /**
     * @param int $promotionState2
     *
     * @return $this
     */
    public function setPromotionState2($promotionState2)
    {
        $this->promotionState2 = $promotionState2;

        return $this;
    }

    /**
     * @return string
     */
    public function getPromotionTitle3()
    {
        return $this->promotionTitle3;
    }

    /**
     * @param string $promotionTitle3
     *
     * @return $this
     */
    public function setPromotionTitle3($promotionTitle3)
    {
        $this->promotionTitle3 = $promotionTitle3;

        return $this;
    }

    /**
     * @return string
     */
    public function getPromotionPrice3()
    {
        return $this->promotionPrice3;
    }

    /**
     * @param string $promotionPrice3
     *
     * @return $this
     */
    public function setPromotionPrice3($promotionPrice3)
    {
        $this->promotionPrice3 = $promotionPrice3;

        return $this;
    }

    /**
     * @return string
     */
    public function getPromotionInformation3()
    {
        return $this->promotionInformation3;
    }

    /**
     * @param string $promotionInformation3
     *
     * @return $this
     */
    public function setPromotionInformation3($promotionInformation3)
    {
        $this->promotionInformation3 = $promotionInformation3;

        return $this;
    }

    /**
     * @return int
     */
    public function getPromotionState3()
    {
        return $this->promotionState3;
    }

    /**
     * @param int $promotionState3
     *
     * @return $this
     */
    public function setPromotionState3($promotionState3)
    {
        $this->promotionState3 = $promotionState3;

        return $this;
    }

    /**
     * @return string
     */
    public function getPromotionDetailsTitle1()
    {
        return $this->promotionDetailsTitle1;
    }

    /**
     * @param string $promotionDetailsTitle1
     *
     * @return $this
     */
    public function setPromotionDetailsTitle1($promotionDetailsTitle1)
    {
        $this->promotionDetailsTitle1 = $promotionDetailsTitle1;

        return $this;
    }

    /**
     * @return string
     */
    public function getPromotionDetailsPricePrefix1()
    {
        return $this->promotionDetailsPricePrefix1;
    }

    /**
     * @param string $promotionDetailsPricePrefix1
     *
     * @return $this
     */
    public function setPromotionDetailsPricePrefix1($promotionDetailsPricePrefix1)
    {
        $this->promotionDetailsPricePrefix1 = $promotionDetailsPricePrefix1;

        return $this;
    }

    /**
     * @return string
     */
    public function getPromotionDetailsPrice1()
    {
        return $this->promotionDetailsPrice1;
    }

    /**
     * @param string $promotionDetailsPrice1
     *
     * @return $this
     */
    public function setPromotionDetailsPrice1($promotionDetailsPrice1)
    {
        $this->promotionDetailsPrice1 = $promotionDetailsPrice1;

        return $this;
    }

    /**
     * @return string
     */
    public function getPromotionDetailsPriceSuffix1()
    {
        return $this->promotionDetailsPriceSuffix1;
    }

    /**
     * @param string $promotionDetailsPriceSuffix1
     *
     * @return $this
     */
    public function setPromotionDetailsPriceSuffix1($promotionDetailsPriceSuffix1)
    {
        $this->promotionDetailsPriceSuffix1 = $promotionDetailsPriceSuffix1;

        return $this;
    }

    /**
     * @return string
     */
    public function getPromotionDetailsInformation1()
    {
        return $this->promotionDetailsInformation1;
    }

    /**
     * @param string $promotionDetailsInformation1
     *
     * @return $this
     */
    public function setPromotionDetailsInformation1($promotionDetailsInformation1)
    {
        $this->promotionDetailsInformation1 = $promotionDetailsInformation1;

        return $this;
    }

    /**
     * @return string
     */
    public function getPromotionDetailsTitle2()
    {
        return $this->promotionDetailsTitle2;
    }

    /**
     * @param string $promotionDetailsTitle2
     *
     * @return $this
     */
    public function setPromotionDetailsTitle2($promotionDetailsTitle2)
    {
        $this->promotionDetailsTitle2 = $promotionDetailsTitle2;

        return $this;
    }

    /**
     * @return string
     */
    public function getPromotionDetailsPricePrefix2()
    {
        return $this->promotionDetailsPricePrefix2;
    }

    /**
     * @param string $promotionDetailsPricePrefix2
     *
     * @return $this
     */
    public function setPromotionDetailsPricePrefix2($promotionDetailsPricePrefix2)
    {
        $this->promotionDetailsPricePrefix2 = $promotionDetailsPricePrefix2;

        return $this;
    }

    /**
     * @return string
     */
    public function getPromotionDetailsPrice2()
    {
        return $this->promotionDetailsPrice2;
    }

    /**
     * @param string $promotionDetailsPrice2
     *
     * @return $this
     */
    public function setPromotionDetailsPrice2($promotionDetailsPrice2)
    {
        $this->promotionDetailsPrice2 = $promotionDetailsPrice2;

        return $this;
    }

    /**
     * @return string
     */
    public function getPromotionDetailsPriceSuffix2()
    {
        return $this->promotionDetailsPriceSuffix2;
    }

    /**
     * @param string $promotionDetailsPriceSuffix2
     *
     * @return $this
     */
    public function setPromotionDetailsPriceSuffix2($promotionDetailsPriceSuffix2)
    {
        $this->promotionDetailsPriceSuffix2 = $promotionDetailsPriceSuffix2;

        return $this;
    }

    /**
     * @return string
     */
    public function getPromotionDetailsInformation2()
    {
        return $this->promotionDetailsInformation2;
    }

    /**
     * @param string $promotionDetailsInformation2
     *
     * @return $this
     */
    public function setPromotionDetailsInformation2($promotionDetailsInformation2)
    {
        $this->promotionDetailsInformation2 = $promotionDetailsInformation2;

        return $this;
    }

    /**
     * @return string
     */
    public function getPromotionDetailsTitle3()
    {
        return $this->promotionDetailsTitle3;
    }

    /**
     * @param string $promotionDetailsTitle3
     *
     * @return $this
     */
    public function setPromotionDetailsTitle3($promotionDetailsTitle3)
    {
        $this->promotionDetailsTitle3 = $promotionDetailsTitle3;

        return $this;
    }

    /**
     * @return string
     */
    public function getPromotionDetailsPricePrefix3()
    {
        return $this->promotionDetailsPricePrefix3;
    }

    /**
     * @param string $promotionDetailsPricePrefix3
     *
     * @return $this
     */
    public function setPromotionDetailsPricePrefix3($promotionDetailsPricePrefix3)
    {
        $this->promotionDetailsPricePrefix3 = $promotionDetailsPricePrefix3;

        return $this;
    }

    /**
     * @return string
     */
    public function getPromotionDetailsPrice3()
    {
        return $this->promotionDetailsPrice3;
    }

    /**
     * @param string $promotionDetailsPrice3
     *
     * @return $this
     */
    public function setPromotionDetailsPrice3($promotionDetailsPrice3)
    {
        $this->promotionDetailsPrice3 = $promotionDetailsPrice3;

        return $this;
    }

    /**
     * @return string
     */
    public function getPromotionDetailsPriceSuffix3()
    {
        return $this->promotionDetailsPriceSuffix3;
    }

    /**
     * @param string $promotionDetailsPriceSuffix3
     *
     * @return $this
     */
    public function setPromotionDetailsPriceSuffix3($promotionDetailsPriceSuffix3)
    {
        $this->promotionDetailsPriceSuffix3 = $promotionDetailsPriceSuffix3;

        return $this;
    }

    /**
     * @return string
     */
    public function getPromotionDetailsInformation3()
    {
        return $this->promotionDetailsInformation3;
    }

    /**
     * @param string $promotionDetailsInformation3
     *
     * @return $this
     */
    public function setPromotionDetailsInformation3($promotionDetailsInformation3)
    {
        $this->promotionDetailsInformation3 = $promotionDetailsInformation3;

        return $this;
    }
}
