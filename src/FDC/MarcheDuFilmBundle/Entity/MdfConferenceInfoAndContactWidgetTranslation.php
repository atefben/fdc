<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfConferenceInfoAndContactWidgetTranslation
 * @ORM\Table(name="mdf_conference_info_and_contact_widget_translation")
 * @ORM\Entity(repositoryClass="FDC\MarcheDuFilmBundle\Repository\MdfConferenceInfoAndContactWidgetTranslationRepository")
 */
class MdfConferenceInfoAndContactWidgetTranslation
{
    use Translation;
    use TranslationChanges;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $name;


    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $post;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $email;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param $post
     *
     * @return $this
     */
    public function setPost($post)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
}
