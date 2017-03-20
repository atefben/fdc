<?php
namespace Base\CoreBundle\Component\Interfaces;

use Application\Sonata\UserBundle\Entity\User;
use Base\CoreBundle\Entity\FilmFestival;
use Base\CoreBundle\Entity\News;
use Base\CoreBundle\Entity\Site;
use Base\CoreBundle\Entity\Theme;
use Doctrine\Common\Collections\Collection;


interface NodeInterface
{

    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set theme
     *
     * @param Theme $theme
     * @return $this
     */
    public function setTheme(Theme $theme = null);

    /**
     * Get theme
     *
     * @return Theme
     */
    public function getTheme();

    /**
     * Set festival
     *
     * @param FilmFestival $festival
     * @return $this
     */
    public function setFestival(FilmFestival $festival = null);

    /**
     * Get festival
     *
     * @return FilmFestival
     */
    public function getFestival();

    /**
     * Add sites
     *
     * @param Site $sites
     * @return $this
     */
    public function addSite(Site $sites);

    /**
     * Remove sites
     *
     * @param Site $sites
     */
    public function removeSite(Site $sites);

    /**
     * Get sites
     *
     * @return Collection
     */
    public function getSites();

    /**
     * Set priorityStatus
     *
     * @param integer $priorityStatus
     * @return $this
     */
    public function setPriorityStatus($priorityStatus);

    /**
     * Get priorityStatus
     *
     * @return integer
     */
    public function getPriorityStatus();

    /**
     * Set displayedHome
     *
     * @param boolean $displayedHome
     * @return $this
     */
    public function setDisplayedHome($displayedHome);

    /**
     * Get displayedHome
     *
     * @return boolean
     */
    public function getDisplayedHome();

    /**
     * Set signature
     *
     * @param string $signature
     * @return $this
     */
    public function setSignature($signature);

    /**
     * Get signature
     *
     * @return string
     */
    public function getSignature();

    /**
     * Set displayedMobile
     *
     * @param boolean $displayedMobile
     * @return $this
     */
    public function setDisplayedMobile($displayedMobile);

    /**
     * Get displayedMobile
     *
     * @return boolean
     */
    public function getDisplayedMobile();

    /**
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     * @return $this
     */
    public function setPublishedAt($publishedAt);

    /**
     * Get publishedAt
     *
     * @return \DateTime
     */
    public function getPublishedAt();

    /**
     * Set publishEndedAt
     *
     * @param \DateTime $publishEndedAt
     * @return $this
     */
    public function setPublishEndedAt($publishEndedAt);

    /**
     * Get publishEndedAt
     *
     * @return \DateTime
     */
    public function getPublishEndedAt();


    /**
     * Set createdBy
     *
     * @param User $createdBy
     * @return $this
     */
    public function setCreatedBy(User $createdBy = null);

    /**
     * Get createdBy
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getCreatedBy();

    /**
     * Set updatedBy
     *
     * @param User $updatedBy
     * @return $this
     */
    public function setUpdatedBy(User $updatedBy = null);

    /**
     * Get updatedBy
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getUpdatedBy();

    /**
     * Set hideSameDay
     *
     * @param boolean $hideSameDay
     * @return $this
     */
    public function setHideSameDay($hideSameDay);

    /**
     * Get hideSameDay
     *
     * @return boolean
     */
    public function getHideSameDay();

    /**
     * Set hidden
     *
     * @param boolean $hidden
     * @return News
     */
    public function setHidden($hidden);

    /**
     * Get hidden
     *
     * @return boolean
     */
    public function getHidden();

    /**
     * Set typeClone
     *
     * @param string $typeClone
     * @return $this
     */
    public function setTypeClone($typeClone);

    /**
     * Get typeClone
     *
     * @return string
     */
    public function getTypeClone();

    /**
     * Set oldNewsId
     *
     * @param integer $oldNewsId
     * @return $this
     */
    public function setOldNewsId($oldNewsId);

    /**
     * Get oldNewsId
     *
     * @return integer
     */
    public function getOldNewsId();

    /**
     * Set oldNewsTable
     *
     * @param string $oldNewsTable
     * @return $this
     */
    public function setOldNewsTable($oldNewsTable);

    /**
     * Get oldNewsTable
     *
     * @return string
     */
    public function getOldNewsTable();

    /**
     * Set mobileDisplay
     *
     * @param string $mobileDisplay
     * @return $this
     */
    public function setMobileDisplay($mobileDisplay);

    /**
     * Get mobileDisplay
     *
     * @return string
     */
    public function getMobileDisplay();
}