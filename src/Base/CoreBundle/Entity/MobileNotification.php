<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * MobileNotification
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\MobileNotificationRepository")
 */
class MobileNotification implements TranslateMainInterface
{
    use Translatable;
    use TranslateMain;

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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $token;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="send_at", type="datetime", nullable=true)
     */
    protected $sendAt;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $sendTest = false;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $sendToAll = false;

    /**
     * @var ArrayCollection
     */
    protected $translations;


    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    public function __toString()
    {
        $string = 'Nouvelle notification mobile';

        if ($this->getId() && $this->findTranslationByLocale('fr')) {
            $string = $this->findTranslationByLocale('fr')->getTitle();
            $string = $this->truncate($string, 40, '..."', true);
        }

        return (string)$string;
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
     * Set title
     *
     * @param string $title
     * @return MobileNotification
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return MobileNotification
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set sendAt
     *
     * @param \DateTime $sendAt
     * @return MobileNotification
     */
    public function setSendAt($sendAt)
    {
        $this->sendAt = $sendAt;

        return $this;
    }

    /**
     * Get sendAt
     *
     * @return \DateTime
     */
    public function getSendAt()
    {
        return $this->sendAt;
    }

    /**
     * Set sendTest
     *
     * @param boolean $sendTest
     * @return MobileNotification
     */
    public function setSendTest($sendTest)
    {
        $this->sendTest = $sendTest;

        return $this;
    }

    /**
     * Get sendTest
     *
     * @return boolean 
     */
    public function getSendTest()
    {
        return $this->sendTest;
    }

    /**
     * @return ArrayCollection
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * @param ArrayCollection $translations
     * @return MobileNotification
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;
        return $this;
    }

    /**
     * Set sendToAll
     *
     * @param boolean $sendToAll
     * @return MobileNotification
     */
    public function setSendToAll($sendToAll)
    {
        $this->sendToAll = $sendToAll;

        return $this;
    }

    /**
     * Get sendToAll
     *
     * @return boolean 
     */
    public function getSendToAll()
    {
        return $this->sendToAll;
    }
}
