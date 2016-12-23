<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldArchiveI18n
 *
 * @ORM\Table(name="old_archive_i18n")
 * @ORM\Entity
 */
class OldArchiveI18n
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="culture", type="string", length=7, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $culture;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_translated", type="boolean", nullable=true)
     */
    protected $isTranslated;

    /**
     * @var string
     *
     * @ORM\Column(name="text1", type="text", nullable=true)
     */
    protected $text1;

    /**
     * @var string
     *
     * @ORM\Column(name="text2", type="text", nullable=true)
     */
    protected $text2;

    /**
     * @var string
     *
     * @ORM\Column(name="text3", type="text", nullable=true)
     */
    protected $text3;

    /**
     * @var string
     *
     * @ORM\Column(name="poster", type="string", length=500, nullable=true)
     */
    protected $poster;

    /**
     * @var string
     *
     * @ORM\Column(name="selection", type="string", length=500, nullable=true)
     */
    protected $selection;

    /**
     * @var string
     *
     * @ORM\Column(name="jury", type="string", length=500, nullable=true)
     */
    protected $jury;

    /**
     * @var string
     *
     * @ORM\Column(name="award", type="string", length=500, nullable=true)
     */
    protected $award;

    /**
     * @var string
     *
     * @ORM\Column(name="around_the_selection", type="string", length=500, nullable=true)
     */
    protected $aroundTheSelection;

    /**
     * @var string
     *
     * @ORM\Column(name="daily", type="string", length=500, nullable=true)
     */
    protected $daily;



    /**
     * Set id
     *
     * @param integer $id
     * @return OldArchiveI18n
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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
     * Set culture
     *
     * @param string $culture
     * @return OldArchiveI18n
     */
    public function setCulture($culture)
    {
        $this->culture = $culture;

        return $this;
    }

    /**
     * Get culture
     *
     * @return string 
     */
    public function getCulture()
    {
        return $this->culture;
    }

    /**
     * Set isTranslated
     *
     * @param boolean $isTranslated
     * @return OldArchiveI18n
     */
    public function setIsTranslated($isTranslated)
    {
        $this->isTranslated = $isTranslated;

        return $this;
    }

    /**
     * Get isTranslated
     *
     * @return boolean 
     */
    public function getIsTranslated()
    {
        return $this->isTranslated;
    }

    /**
     * Set text1
     *
     * @param string $text1
     * @return OldArchiveI18n
     */
    public function setText1($text1)
    {
        $this->text1 = $text1;

        return $this;
    }

    /**
     * Get text1
     *
     * @return string 
     */
    public function getText1()
    {
        return $this->text1;
    }

    /**
     * Set text2
     *
     * @param string $text2
     * @return OldArchiveI18n
     */
    public function setText2($text2)
    {
        $this->text2 = $text2;

        return $this;
    }

    /**
     * Get text2
     *
     * @return string 
     */
    public function getText2()
    {
        return $this->text2;
    }

    /**
     * Set text3
     *
     * @param string $text3
     * @return OldArchiveI18n
     */
    public function setText3($text3)
    {
        $this->text3 = $text3;

        return $this;
    }

    /**
     * Get text3
     *
     * @return string 
     */
    public function getText3()
    {
        return $this->text3;
    }

    /**
     * Set poster
     *
     * @param string $poster
     * @return OldArchiveI18n
     */
    public function setPoster($poster)
    {
        $this->poster = $poster;

        return $this;
    }

    /**
     * Get poster
     *
     * @return string 
     */
    public function getPoster()
    {
        return $this->poster;
    }

    /**
     * Set selection
     *
     * @param string $selection
     * @return OldArchiveI18n
     */
    public function setSelection($selection)
    {
        $this->selection = $selection;

        return $this;
    }

    /**
     * Get selection
     *
     * @return string 
     */
    public function getSelection()
    {
        return $this->selection;
    }

    /**
     * Set jury
     *
     * @param string $jury
     * @return OldArchiveI18n
     */
    public function setJury($jury)
    {
        $this->jury = $jury;

        return $this;
    }

    /**
     * Get jury
     *
     * @return string 
     */
    public function getJury()
    {
        return $this->jury;
    }

    /**
     * Set award
     *
     * @param string $award
     * @return OldArchiveI18n
     */
    public function setAward($award)
    {
        $this->award = $award;

        return $this;
    }

    /**
     * Get award
     *
     * @return string 
     */
    public function getAward()
    {
        return $this->award;
    }

    /**
     * Set aroundTheSelection
     *
     * @param string $aroundTheSelection
     * @return OldArchiveI18n
     */
    public function setAroundTheSelection($aroundTheSelection)
    {
        $this->aroundTheSelection = $aroundTheSelection;

        return $this;
    }

    /**
     * Get aroundTheSelection
     *
     * @return string 
     */
    public function getAroundTheSelection()
    {
        return $this->aroundTheSelection;
    }

    /**
     * Set daily
     *
     * @param string $daily
     * @return OldArchiveI18n
     */
    public function setDaily($daily)
    {
        $this->daily = $daily;

        return $this;
    }

    /**
     * Get daily
     *
     * @return string 
     */
    public function getDaily()
    {
        return $this->daily;
    }
}
