<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FDCPageAwardTranslation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\FDCPageAwardTranslationRepository")
 */
class FDCPageAwardTranslation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="yes", type="string", length=255)
     */
    private $yes;


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
     * Set yes
     *
     * @param string $yes
     * @return FDCPageAwardTranslation
     */
    public function setYes($yes)
    {
        $this->yes = $yes;

        return $this;
    }

    /**
     * Get yes
     *
     * @return string 
     */
    public function getYes()
    {
        return $this->yes;
    }
}
