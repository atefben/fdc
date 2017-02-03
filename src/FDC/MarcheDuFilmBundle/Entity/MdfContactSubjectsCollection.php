<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * MdfContactSubjectsCollection
 *
 * @ORM\Table(name="mdf_contact_subjects_collection")
 * @ORM\Entity(repositoryClass="FDC\MarcheDuFilmBundle\Repository\MdfContactSubjectsCollectionRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class MdfContactSubjectsCollection
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfContactSubject", inversedBy="contactSubjectsCollection")
     * @ORM\JoinColumn(name="contact_subject__id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $contactSubject;

    /**
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfContactPage", inversedBy="subjectsList")
     * @ORM\JoinColumn(name="contact_page_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $contactPage;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $position;

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
     * @return mixed
     */
    public function getContactSubject()
    {
        return $this->contactSubject;
    }

    /**
     * @param mixed $contactSubject
     */
    public function setContactSubject($contactSubject)
    {
        $this->contactSubject = $contactSubject;
    }

    /**
     * @return mixed
     */
    public function getContactPage()
    {
        return $this->contactPage;
    }

    /**
     * @param mixed $contactPage
     */
    public function setContactPage($contactPage)
    {
        $this->contactPage = $contactPage;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }
}
