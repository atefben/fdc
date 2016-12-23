<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldPartenaire
 *
 * @ORM\Table(name="old_partenaire")
 * @ORM\Entity
 */
class OldPartenaire
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="type", type="boolean", nullable=false)
     */
    protected $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="priority", type="integer", nullable=true)
     */
    protected $priority;

    /**
     * @var integer
     *
     * @ORM\Column(name="view_on_dashboard", type="integer", nullable=false)
     */
    protected $viewOnDashboard;

    /**
     * @var integer
     *
     * @ORM\Column(name="pin_on_dashboard", type="integer", nullable=false)
     */
    protected $pinOnDashboard;

    /**
     * @var integer
     *
     * @ORM\Column(name="dashboard_priority", type="integer", nullable=false)
     */
    protected $dashboardPriority;

    /**
     * @var integer
     *
     * @ORM\Column(name="translation_status", type="integer", nullable=false)
     */
    protected $translationStatus;



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
     * Set type
     *
     * @param boolean $type
     * @return OldPartenaire
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return boolean 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set priority
     *
     * @param integer $priority
     * @return OldPartenaire
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer 
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set viewOnDashboard
     *
     * @param integer $viewOnDashboard
     * @return OldPartenaire
     */
    public function setViewOnDashboard($viewOnDashboard)
    {
        $this->viewOnDashboard = $viewOnDashboard;

        return $this;
    }

    /**
     * Get viewOnDashboard
     *
     * @return integer 
     */
    public function getViewOnDashboard()
    {
        return $this->viewOnDashboard;
    }

    /**
     * Set pinOnDashboard
     *
     * @param integer $pinOnDashboard
     * @return OldPartenaire
     */
    public function setPinOnDashboard($pinOnDashboard)
    {
        $this->pinOnDashboard = $pinOnDashboard;

        return $this;
    }

    /**
     * Get pinOnDashboard
     *
     * @return integer 
     */
    public function getPinOnDashboard()
    {
        return $this->pinOnDashboard;
    }

    /**
     * Set dashboardPriority
     *
     * @param integer $dashboardPriority
     * @return OldPartenaire
     */
    public function setDashboardPriority($dashboardPriority)
    {
        $this->dashboardPriority = $dashboardPriority;

        return $this;
    }

    /**
     * Get dashboardPriority
     *
     * @return integer 
     */
    public function getDashboardPriority()
    {
        return $this->dashboardPriority;
    }

    /**
     * Set translationStatus
     *
     * @param integer $translationStatus
     * @return OldPartenaire
     */
    public function setTranslationStatus($translationStatus)
    {
        $this->translationStatus = $translationStatus;

        return $this;
    }

    /**
     * Get translationStatus
     *
     * @return integer 
     */
    public function getTranslationStatus()
    {
        return $this->translationStatus;
    }
}
