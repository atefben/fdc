<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\TruncatePro;

use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Groups;


/**
 * OrangeSeriesAndCie
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *      "series" = "OrangeSeriesAndCie", 
 *      "ocs" = "OrangeProgrammationOCS",
 *      "vod" = "OrangeVideoOnDemand",
 *      "studio" = "OrangeStudio",
 * })
 */
abstract class Orange implements TranslateMainInterface
{
    use Time;
    use TranslateMain;
    use TruncatePro;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var OrangeWidget
     *
     * @ORM\OneToMany(targetEntity="OrangeWidget", mappedBy="parent", cascade={"all"}, orphanRemoval=true)
     *
     * @ORM\OrderBy({"position" = "ASC"})
     * 
     * @Groups({
     *     "orange_series_and_cie",
     *     "orange_programmation_ocs"
     * })
     */
    protected $widgets;
    
    /**
     * ArrayCollection
     * @Groups({
     *     "orange_series_and_cie",
     *     "orange_programmation_ocs"
     * })
     */
    protected $translations;

    
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->widgets = new ArrayCollection();
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
     * Add widgets
     *
     * @param \Base\CoreBundle\Entity\OrangeWidget $widgets
     * @return OrangeSeriesAndCie
     */
    public function addWidget(\Base\CoreBundle\Entity\OrangeWidget $widgets)
    {
        $widgets->setParent($this);
        $this->widgets[] = $widgets;

        return $this;
    }

    /**
     * Remove widgets
     *
     * @param \Base\CoreBundle\Entity\OrangeWidget $widgets
     */
    public function removeWidget(\Base\CoreBundle\Entity\OrangeWidget $widgets)
    {
        $this->widgets->removeElement($widgets);
    }
    
    /**
     * Set widgets
     *
     * @param string $widgets
     * @return OrangeSeriesAndCie
     */
    public function setWidgets($widgets)
    {
        $this->widgets = $widgets;

        return $this;
    }

    /**
     * Get widgets
     *
     * @return string 
     */
    public function getWidgets()
    {
        return $this->widgets;
    }
    
    /**
     * getAvailableTranslateOptions function.
     *
     * @access public
     * @static
     * @return void
     */
    public static function getAvailableTranslateOptions()
    {
        return array(
            self::TRANSLATE_OPTION_EN => 'form.translate_option.en',
        );
    }
}
