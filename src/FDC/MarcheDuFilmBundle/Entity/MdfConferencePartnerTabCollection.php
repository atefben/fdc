<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfConferencePartnerTabCollection
 * @ORM\Table(name="mdf_conference_partner_tab_collection")
 * @ORM\Entity
 */
class MdfConferencePartnerTabCollection
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
     * @ORM\ManyToOne(targetEntity="MdfConferencePartnerTab", cascade={"all"})
     * @Assert\Count(
     *      max = "4",
     *      min = "1",
     *      minMessage = "validation.partners_tab_min",
     *      maxMessage = "validation.partners_tab_max"
     * )
     */
    protected $conferencePartnerTab;

    /**
     * @ORM\ManyToOne(targetEntity="MdfConferencePartner", inversedBy="partnerTabCollection")
     */
    protected $conferencePartner;

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
     * @return mixed
     */
    public function getConferencePartner()
    {
        return $this->conferencePartner;
    }

    /**
     * @param $conferencePartner
     *
     * @return $this
     */
    public function setConferencePartner($conferencePartner)
    {
        $this->conferencePartner = $conferencePartner;

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
