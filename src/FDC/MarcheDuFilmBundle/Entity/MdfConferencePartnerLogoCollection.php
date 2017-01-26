<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\ManyToOne(targetEntity="MdfConferencePartnerLogo")
     */
    protected $conferencePartnerLogo;

    /**
     * @ORM\ManyToOne(targetEntity="MdfConferencePartnerTab", inversedBy="partnerLogoCollection")
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
