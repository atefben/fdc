<?php

namespace Base\CoreBundle\Entity;

use Base\CoreBundle\Interfaces\FDCEventRoutesInterface;
use Base\CoreBundle\Util\Time;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * FDCCorporateRoutes
 *
 * @Gedmo\Tree(type="nested")
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\FDCCorporateRoutesRepository")
 * @ORM\HasLifecycleCallbacks
 */
class FDCCorporateRoutes implements FDCEventRoutesInterface
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     *
     */
    protected $route;

    /**
     * @var string
     *
     * @ORM\Column(type="boolean", nullable=false)
     *
     */
    protected $hasWaitingPage;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", nullable=false)
     *
     */
    protected $site;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", nullable=false)
     *
     */
    protected $type;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     *
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     *
     */
    protected $transName;

    /**
     * @var string
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected $enabled;

    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(name="lft", type="integer")
     */
    protected $lft;
    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl", type="integer")
     */
    protected $lvl;
    /**
     * @Gedmo\TreeRight
     * @ORM\Column(name="rgt", type="integer")
     */
    protected $rgt;
    /**
     * @Gedmo\TreeRoot
     * @ORM\Column(name="root", type="integer", nullable=true)
     */
    protected $root;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected $hidden;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="FDCCorporateRoutes", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $parent;

    /**
     * @ORM\OneToMany(targetEntity="FDCCorporateRoutes", mappedBy="parent")
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $children;

    /**
     * @Gedmo\Slug(handlers={
     *      @Gedmo\SlugHandler(class="Gedmo\Sluggable\Handler\TreeSlugHandler", options={
     *          @Gedmo\SlugHandlerOption(name="parentRelationField", value="parent"),
     *          @Gedmo\SlugHandlerOption(name="separator", value="/")
     *      })
     * }, fields={"route"})
     * @Doctrine\ORM\Mapping\Column(length=255, nullable=true)
     */
    protected $slug;

    /**
     * @ORM\Column(name="position", type="integer", nullable=false, options={"default" = 0})
     */
    protected $position = 0;


    public function __construct()
    {
        $this->enabled = false;
        $this->hidden = false;
    }

    public function __toString()
    {
        if ($this->getId()) {

            if (isset($_SERVER) && isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], 'fdcpagewaiting')) {
                if ($this->getSite() == 1) {
                    $name = 'Evènementiel';
                }  else if ($this->getSite() == 2) {
                    $name = 'Presse';
                }

                return $name. ' - '. $this->getName();
            }

            return $this->getName();
        }

        return '';
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
     * Set route
     *
     * @param string $route
     * @return FDCCorporateRoutes
     */
    public function setRoute($route)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Get route
     *
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return FDCCorporateRoutes
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set lft
     *
     * @param integer $lft
     * @return FDCCorporateRoutes
     */
    public function setLft($lft)
    {
        $this->lft = $lft;

        return $this;
    }

    /**
     * Get lft
     *
     * @return integer
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * Set lvl
     *
     * @param integer $lvl
     * @return FDCCorporateRoutes
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;

        return $this;
    }

    /**
     * Get lvl
     *
     * @return integer
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * Set rgt
     *
     * @param integer $rgt
     * @return FDCCorporateRoutes
     */
    public function setRgt($rgt)
    {
        $this->rgt = $rgt;

        return $this;
    }

    /**
     * Get rgt
     *
     * @return integer
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * Set root
     *
     * @param integer $root
     * @return FDCCorporateRoutes
     */
    public function setRoot($root)
    {
        $this->root = $root;

        return $this;
    }

    /**
     * Get root
     *
     * @return integer
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return FDCCorporateRoutes
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return FDCCorporateRoutes
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set parent
     *
     * @param \Base\CoreBundle\Entity\FDCCorporateRoutes $parent
     * @return FDCCorporateRoutes
     */
    public function setParent(\Base\CoreBundle\Entity\FDCCorporateRoutes $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Base\CoreBundle\Entity\FDCCorporateRoutes
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add children
     *
     * @param \Base\CoreBundle\Entity\FDCCorporateRoutes $children
     * @return FDCCorporateRoutes
     */
    public function addChild(\Base\CoreBundle\Entity\FDCCorporateRoutes $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \Base\CoreBundle\Entity\FDCCorporateRoutes $children
     */
    public function removeChild(\Base\CoreBundle\Entity\FDCCorporateRoutes $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return FDCCorporateRoutes
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set transName
     *
     * @param string $transName
     * @return FDCCorporateRoutes
     */
    public function setTransName($transName)
    {
        $this->transName = $transName;

        return $this;
    }

    /**
     * Get transName
     *
     * @return string
     */
    public function getTransName()
    {
        return $this->transName;
    }

    /**
     * Set hidden
     *
     * @param boolean $hidden
     * @return FDCCorporateRoutes
     */
    public function setHidden($hidden)
    {
        $this->hidden = $hidden;

        return $this;
    }

    /**
     * Get hidden
     *
     * @return boolean
     */
    public function getHidden()
    {
        return $this->hidden;
    }

    /**
     * Set hasWaitingPage
     *
     * @param boolean $hasWaitingPage
     * @return FDCCorporateRoutes
     */
    public function setHasWaitingPage($hasWaitingPage)
    {
        $this->hasWaitingPage = $hasWaitingPage;

        return $this;
    }

    /**
     * Get hasWaitingPage
     *
     * @return boolean
     */
    public function getHasWaitingPage()
    {
        return $this->hasWaitingPage;
    }

    /**
     * Set site
     *
     * @param integer $site
     * @return FDCCorporateRoutes
     */
    public function setSite($site)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return integer
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return FDCCorporateRoutes
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }
}
