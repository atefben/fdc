<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * MdfConferencePartnerLogoCollection
 * @ORM\Table(name="mdf_conference_partner_logo_collection")
 * @ORM\Entity
 */
class MdfConferencePartnerLogoCollection
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="MdfConferencePartnerLogo", inversedBy="conferencePartnerLogoCollection")
     * @Assert\Count(
     *      min = "1",
     *      minMessage = "validation.partners_logo_max",
     *      max = "4",
     *      maxMessage = "validation.partners_logo_max"
     * )
     * @ORM\JoinColumn(name="conference_partner_logo_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $conferencePartnerLogo;

    /**
     * @ORM\ManyToOne(targetEntity="MdfConferencePartnerTab", inversedBy="partnerLogoCollection")
     * @ORM\JoinColumn(name="conference_partner_tab_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $conferencePartnerTab;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $position;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getConferencePartnerLogo()
    {
        return $this->conferencePartnerLogo;
    }

    /**
     * @param $conferencePartnerLogo
     *
     * @return $this
     */
    public function setConferencePartnerLogo($conferencePartnerLogo)
    {
        $this->conferencePartnerLogo = $conferencePartnerLogo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getConferencePartnerTab()
    {
        return $this->conferencePartnerTab;
    }

    /**
     * @param $conferencePartnerTab
     *
     * @return $this
     */
    public function setConferencePartnerTab($conferencePartnerTab)
    {
        $this->conferencePartnerTab = $conferencePartnerTab;

        return $this;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param $position
     *
     * @return $this
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }
}
