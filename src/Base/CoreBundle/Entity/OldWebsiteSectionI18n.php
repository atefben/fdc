<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldWebsiteSectionI18n
 *
 * @ORM\Table(name="old_website_section_i18n")
 * @ORM\Entity
 */
class OldWebsiteSectionI18n
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
     * @var string
     *
     * @ORM\Column(name="menu_template", type="string", length=250, nullable=true)
     */
    protected $menuTemplate;

    /**
     * @var string
     *
     * @ORM\Column(name="display_name", type="string", length=100, nullable=false)
     */
    protected $displayName;

    /**
     * @var string
     *
     * @ORM\Column(name="tooltip", type="string", length=250, nullable=false)
     */
    protected $tooltip;



    /**
     * Set id
     *
     * @param integer $id
     * @return OldWebsiteSectionI18n
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
     * @return OldWebsiteSectionI18n
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
     * Set menuTemplate
     *
     * @param string $menuTemplate
     * @return OldWebsiteSectionI18n
     */
    public function setMenuTemplate($menuTemplate)
    {
        $this->menuTemplate = $menuTemplate;

        return $this;
    }

    /**
     * Get menuTemplate
     *
     * @return string 
     */
    public function getMenuTemplate()
    {
        return $this->menuTemplate;
    }

    /**
     * Set displayName
     *
     * @param string $displayName
     * @return OldWebsiteSectionI18n
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;

        return $this;
    }

    /**
     * Get displayName
     *
     * @return string 
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * Set tooltip
     *
     * @param string $tooltip
     * @return OldWebsiteSectionI18n
     */
    public function setTooltip($tooltip)
    {
        $this->tooltip = $tooltip;

        return $this;
    }

    /**
     * Get tooltip
     *
     * @return string 
     */
    public function getTooltip()
    {
        return $this->tooltip;
    }
}
