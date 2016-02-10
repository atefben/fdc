<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Util\TranslateMain;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * HomepageTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class HomepageTranslation
{
    use Time;
    use Translation;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $primaryPushTitle1;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $primaryPushTitle2;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $primaryPushTitle3;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $secondaryPushTitle1;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $secondaryPushTitle2;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $secondaryPushTitle3;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $secondaryPushTitle4;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $secondaryPushTitle5;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $secondaryPushTitle6;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $secondaryPushTitle7;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $secondaryPushTitle8;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $primaryPushUrl1;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $primaryPushUrl2;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $primaryPushUrl3;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $secondaryPushUrl1;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $secondaryPushUrl2;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $secondaryPushUrl3;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $secondaryPushUrl4;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $secondaryPushUrl5;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $secondaryPushUrl6;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $secondaryPushUrl7;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $secondaryPushUrl8;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $prefooterTitle1;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $prefooterTitle2;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $prefooterTitle3;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $prefooterTitle4;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $prefooterUrl1;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $prefooterUrl2;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $prefooterUrl3;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     **/
    private $prefooterUrl4;

    /**
     * @var Prefooter
     *
     * @ORM\OneToMany(targetEntity="Prefooter", mappedBy="homepageTranslation")
     */
    private $prefooters;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->prefooters = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Add prefooters
     *
     * @param \Base\CoreBundle\Entity\Prefooter $prefooters
     * @return HomepageTranslation
     */
    public function addPrefooter(\Base\CoreBundle\Entity\Prefooter $prefooters)
    {
        $this->prefooters[] = $prefooters;

        return $this;
    }

    /**
     * Remove prefooters
     *
     * @param \Base\CoreBundle\Entity\Prefooter $prefooters
     */
    public function removePrefooter(\Base\CoreBundle\Entity\Prefooter $prefooters)
    {
        $this->prefooters->removeElement($prefooters);
    }

    /**
     * Get prefooters
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPrefooters()
    {
        return $this->prefooters;
    }

    /**
     * Set primaryPushTitle1
     *
     * @param string $primaryPushTitle1
     * @return HomepageTranslation
     */
    public function setPrimaryPushTitle1($primaryPushTitle1)
    {
        $this->primaryPushTitle1 = $primaryPushTitle1;

        return $this;
    }

    /**
     * Get primaryPushTitle1
     *
     * @return string 
     */
    public function getPrimaryPushTitle1()
    {
        return $this->primaryPushTitle1;
    }

    /**
     * Set primaryPushTitle2
     *
     * @param string $primaryPushTitle2
     * @return HomepageTranslation
     */
    public function setPrimaryPushTitle2($primaryPushTitle2)
    {
        $this->primaryPushTitle2 = $primaryPushTitle2;

        return $this;
    }

    /**
     * Get primaryPushTitle2
     *
     * @return string 
     */
    public function getPrimaryPushTitle2()
    {
        return $this->primaryPushTitle2;
    }

    /**
     * Set primaryPushTitle3
     *
     * @param string $primaryPushTitle3
     * @return HomepageTranslation
     */
    public function setPrimaryPushTitle3($primaryPushTitle3)
    {
        $this->primaryPushTitle3 = $primaryPushTitle3;

        return $this;
    }

    /**
     * Get primaryPushTitle3
     *
     * @return string 
     */
    public function getPrimaryPushTitle3()
    {
        return $this->primaryPushTitle3;
    }

    /**
     * Set secondaryPushTitle1
     *
     * @param string $secondaryPushTitle1
     * @return HomepageTranslation
     */
    public function setSecondaryPushTitle1($secondaryPushTitle1)
    {
        $this->secondaryPushTitle1 = $secondaryPushTitle1;

        return $this;
    }

    /**
     * Get secondaryPushTitle1
     *
     * @return string 
     */
    public function getSecondaryPushTitle1()
    {
        return $this->secondaryPushTitle1;
    }

    /**
     * Set secondaryPushTitle2
     *
     * @param string $secondaryPushTitle2
     * @return HomepageTranslation
     */
    public function setSecondaryPushTitle2($secondaryPushTitle2)
    {
        $this->secondaryPushTitle2 = $secondaryPushTitle2;

        return $this;
    }

    /**
     * Get secondaryPushTitle2
     *
     * @return string 
     */
    public function getSecondaryPushTitle2()
    {
        return $this->secondaryPushTitle2;
    }

    /**
     * Set secondaryPushTitle3
     *
     * @param string $secondaryPushTitle3
     * @return HomepageTranslation
     */
    public function setSecondaryPushTitle3($secondaryPushTitle3)
    {
        $this->secondaryPushTitle3 = $secondaryPushTitle3;

        return $this;
    }

    /**
     * Get secondaryPushTitle3
     *
     * @return string 
     */
    public function getSecondaryPushTitle3()
    {
        return $this->secondaryPushTitle3;
    }

    /**
     * Set secondaryPushTitle4
     *
     * @param string $secondaryPushTitle4
     * @return HomepageTranslation
     */
    public function setSecondaryPushTitle4($secondaryPushTitle4)
    {
        $this->secondaryPushTitle4 = $secondaryPushTitle4;

        return $this;
    }

    /**
     * Get secondaryPushTitle4
     *
     * @return string 
     */
    public function getSecondaryPushTitle4()
    {
        return $this->secondaryPushTitle4;
    }

    /**
     * Set secondaryPushTitle5
     *
     * @param string $secondaryPushTitle5
     * @return HomepageTranslation
     */
    public function setSecondaryPushTitle5($secondaryPushTitle5)
    {
        $this->secondaryPushTitle5 = $secondaryPushTitle5;

        return $this;
    }

    /**
     * Get secondaryPushTitle5
     *
     * @return string 
     */
    public function getSecondaryPushTitle5()
    {
        return $this->secondaryPushTitle5;
    }

    /**
     * Set secondaryPushTitle6
     *
     * @param string $secondaryPushTitle6
     * @return HomepageTranslation
     */
    public function setSecondaryPushTitle6($secondaryPushTitle6)
    {
        $this->secondaryPushTitle6 = $secondaryPushTitle6;

        return $this;
    }

    /**
     * Get secondaryPushTitle6
     *
     * @return string 
     */
    public function getSecondaryPushTitle6()
    {
        return $this->secondaryPushTitle6;
    }

    /**
     * Set secondaryPushTitle7
     *
     * @param string $secondaryPushTitle7
     * @return HomepageTranslation
     */
    public function setSecondaryPushTitle7($secondaryPushTitle7)
    {
        $this->secondaryPushTitle7 = $secondaryPushTitle7;

        return $this;
    }

    /**
     * Get secondaryPushTitle7
     *
     * @return string 
     */
    public function getSecondaryPushTitle7()
    {
        return $this->secondaryPushTitle7;
    }

    /**
     * Set secondaryPushTitle8
     *
     * @param string $secondaryPushTitle8
     * @return HomepageTranslation
     */
    public function setSecondaryPushTitle8($secondaryPushTitle8)
    {
        $this->secondaryPushTitle8 = $secondaryPushTitle8;

        return $this;
    }

    /**
     * Get secondaryPushTitle8
     *
     * @return string 
     */
    public function getSecondaryPushTitle8()
    {
        return $this->secondaryPushTitle8;
    }

    /**
     * Set primaryPushUrl1
     *
     * @param string $primaryPushUrl1
     * @return HomepageTranslation
     */
    public function setPrimaryPushUrl1($primaryPushUrl1)
    {
        $this->primaryPushUrl1 = $primaryPushUrl1;

        return $this;
    }

    /**
     * Get primaryPushUrl1
     *
     * @return string 
     */
    public function getPrimaryPushUrl1()
    {
        return $this->primaryPushUrl1;
    }

    /**
     * Set primaryPushUrl2
     *
     * @param string $primaryPushUrl2
     * @return HomepageTranslation
     */
    public function setPrimaryPushUrl2($primaryPushUrl2)
    {
        $this->primaryPushUrl2 = $primaryPushUrl2;

        return $this;
    }

    /**
     * Get primaryPushUrl2
     *
     * @return string 
     */
    public function getPrimaryPushUrl2()
    {
        return $this->primaryPushUrl2;
    }

    /**
     * Set primaryPushUrl3
     *
     * @param string $primaryPushUrl3
     * @return HomepageTranslation
     */
    public function setPrimaryPushUrl3($primaryPushUrl3)
    {
        $this->primaryPushUrl3 = $primaryPushUrl3;

        return $this;
    }

    /**
     * Get primaryPushUrl3
     *
     * @return string 
     */
    public function getPrimaryPushUrl3()
    {
        return $this->primaryPushUrl3;
    }

    /**
     * Set secondaryPushUrl1
     *
     * @param string $secondaryPushUrl1
     * @return HomepageTranslation
     */
    public function setSecondaryPushUrl1($secondaryPushUrl1)
    {
        $this->secondaryPushUrl1 = $secondaryPushUrl1;

        return $this;
    }

    /**
     * Get secondaryPushUrl1
     *
     * @return string 
     */
    public function getSecondaryPushUrl1()
    {
        return $this->secondaryPushUrl1;
    }

    /**
     * Set secondaryPushUrl2
     *
     * @param string $secondaryPushUrl2
     * @return HomepageTranslation
     */
    public function setSecondaryPushUrl2($secondaryPushUrl2)
    {
        $this->secondaryPushUrl2 = $secondaryPushUrl2;

        return $this;
    }

    /**
     * Get secondaryPushUrl2
     *
     * @return string 
     */
    public function getSecondaryPushUrl2()
    {
        return $this->secondaryPushUrl2;
    }

    /**
     * Set secondaryPushUrl3
     *
     * @param string $secondaryPushUrl3
     * @return HomepageTranslation
     */
    public function setSecondaryPushUrl3($secondaryPushUrl3)
    {
        $this->secondaryPushUrl3 = $secondaryPushUrl3;

        return $this;
    }

    /**
     * Get secondaryPushUrl3
     *
     * @return string 
     */
    public function getSecondaryPushUrl3()
    {
        return $this->secondaryPushUrl3;
    }

    /**
     * Set secondaryPushUrl4
     *
     * @param string $secondaryPushUrl4
     * @return HomepageTranslation
     */
    public function setSecondaryPushUrl4($secondaryPushUrl4)
    {
        $this->secondaryPushUrl4 = $secondaryPushUrl4;

        return $this;
    }

    /**
     * Get secondaryPushUrl4
     *
     * @return string 
     */
    public function getSecondaryPushUrl4()
    {
        return $this->secondaryPushUrl4;
    }

    /**
     * Set secondaryPushUrl5
     *
     * @param string $secondaryPushUrl5
     * @return HomepageTranslation
     */
    public function setSecondaryPushUrl5($secondaryPushUrl5)
    {
        $this->secondaryPushUrl5 = $secondaryPushUrl5;

        return $this;
    }

    /**
     * Get secondaryPushUrl5
     *
     * @return string 
     */
    public function getSecondaryPushUrl5()
    {
        return $this->secondaryPushUrl5;
    }

    /**
     * Set secondaryPushUrl6
     *
     * @param string $secondaryPushUrl6
     * @return HomepageTranslation
     */
    public function setSecondaryPushUrl6($secondaryPushUrl6)
    {
        $this->secondaryPushUrl6 = $secondaryPushUrl6;

        return $this;
    }

    /**
     * Get secondaryPushUrl6
     *
     * @return string 
     */
    public function getSecondaryPushUrl6()
    {
        return $this->secondaryPushUrl6;
    }

    /**
     * Set secondaryPushUrl7
     *
     * @param string $secondaryPushUrl7
     * @return HomepageTranslation
     */
    public function setSecondaryPushUrl7($secondaryPushUrl7)
    {
        $this->secondaryPushUrl7 = $secondaryPushUrl7;

        return $this;
    }

    /**
     * Get secondaryPushUrl7
     *
     * @return string 
     */
    public function getSecondaryPushUrl7()
    {
        return $this->secondaryPushUrl7;
    }

    /**
     * Set secondaryPushUrl8
     *
     * @param string $secondaryPushUrl8
     * @return HomepageTranslation
     */
    public function setSecondaryPushUrl8($secondaryPushUrl8)
    {
        $this->secondaryPushUrl8 = $secondaryPushUrl8;

        return $this;
    }

    /**
     * Get secondaryPushUrl8
     *
     * @return string 
     */
    public function getSecondaryPushUrl8()
    {
        return $this->secondaryPushUrl8;
    }

    /**
     * Set prefooterTitle1
     *
     * @param string $prefooterTitle1
     * @return HomepageTranslation
     */
    public function setPrefooterTitle1($prefooterTitle1)
    {
        $this->prefooterTitle1 = $prefooterTitle1;

        return $this;
    }

    /**
     * Get prefooterTitle1
     *
     * @return string 
     */
    public function getPrefooterTitle1()
    {
        return $this->prefooterTitle1;
    }

    /**
     * Set prefooterTitle2
     *
     * @param string $prefooterTitle2
     * @return HomepageTranslation
     */
    public function setPrefooterTitle2($prefooterTitle2)
    {
        $this->prefooterTitle2 = $prefooterTitle2;

        return $this;
    }

    /**
     * Get prefooterTitle2
     *
     * @return string 
     */
    public function getPrefooterTitle2()
    {
        return $this->prefooterTitle2;
    }

    /**
     * Set prefooterTitle3
     *
     * @param string $prefooterTitle3
     * @return HomepageTranslation
     */
    public function setPrefooterTitle3($prefooterTitle3)
    {
        $this->prefooterTitle3 = $prefooterTitle3;

        return $this;
    }

    /**
     * Get prefooterTitle3
     *
     * @return string 
     */
    public function getPrefooterTitle3()
    {
        return $this->prefooterTitle3;
    }

    /**
     * Set prefooterTitle4
     *
     * @param string $prefooterTitle4
     * @return HomepageTranslation
     */
    public function setPrefooterTitle4($prefooterTitle4)
    {
        $this->prefooterTitle4 = $prefooterTitle4;

        return $this;
    }

    /**
     * Get prefooterTitle4
     *
     * @return string 
     */
    public function getPrefooterTitle4()
    {
        return $this->prefooterTitle4;
    }

    /**
     * Set prefooterUrl1
     *
     * @param string $prefooterUrl1
     * @return HomepageTranslation
     */
    public function setPrefooterUrl1($prefooterUrl1)
    {
        $this->prefooterUrl1 = $prefooterUrl1;

        return $this;
    }

    /**
     * Get prefooterUrl1
     *
     * @return string 
     */
    public function getPrefooterUrl1()
    {
        return $this->prefooterUrl1;
    }

    /**
     * Set prefooterUrl2
     *
     * @param string $prefooterUrl2
     * @return HomepageTranslation
     */
    public function setPrefooterUrl2($prefooterUrl2)
    {
        $this->prefooterUrl2 = $prefooterUrl2;

        return $this;
    }

    /**
     * Get prefooterUrl2
     *
     * @return string 
     */
    public function getPrefooterUrl2()
    {
        return $this->prefooterUrl2;
    }

    /**
     * Set prefooterUrl3
     *
     * @param string $prefooterUrl3
     * @return HomepageTranslation
     */
    public function setPrefooterUrl3($prefooterUrl3)
    {
        $this->prefooterUrl3 = $prefooterUrl3;

        return $this;
    }

    /**
     * Get prefooterUrl3
     *
     * @return string 
     */
    public function getPrefooterUrl3()
    {
        return $this->prefooterUrl3;
    }

    /**
     * Set prefooterUrl4
     *
     * @param string $prefooterUrl4
     * @return HomepageTranslation
     */
    public function setPrefooterUrl4($prefooterUrl4)
    {
        $this->prefooterUrl4 = $prefooterUrl4;

        return $this;
    }

    /**
     * Get prefooterUrl4
     *
     * @return string 
     */
    public function getPrefooterUrl4()
    {
        return $this->prefooterUrl4;
    }
}
