<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldArticleExtraFieldI18n
 *
 * @ORM\Table(name="old_article_extra_field_i18n", indexes={@ORM\Index(name="article_extra_field_i18n_FK_1", columns={"id"})})
 * @ORM\Entity
 */
class OldArticleExtraFieldI18n
{
    /**
     * @var integer
     *
     * @ORM\Column(name="autoincrement", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $autoincrement;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="culture", type="string", length=7, nullable=false)
     */
    protected $culture;

    /**
     * @var string
     *
     * @ORM\Column(name="pdf_file_label", type="string", length=255, nullable=false)
     */
    protected $pdfFileLabel;

    /**
     * @var string
     *
     * @ORM\Column(name="pdf_file", type="string", length=255, nullable=false)
     */
    protected $pdfFile;

    /**
     * @var string
     *
     * @ORM\Column(name="external_file_label", type="string", length=255, nullable=false)
     */
    protected $externalFileLabel;

    /**
     * @var string
     *
     * @ORM\Column(name="external_file", type="string", length=255, nullable=false)
     */
    protected $externalFile;

    /**
     * @var string
     *
     * @ORM\Column(name="source", type="string", length=255, nullable=true)
     */
    protected $source;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="article_date", type="datetime", nullable=false)
     */
    protected $articleDate;



    /**
     * Get autoincrement
     *
     * @return integer 
     */
    public function getAutoincrement()
    {
        return $this->autoincrement;
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return OldArticleExtraFieldI18n
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Set culture
     *
     * @param string $culture
     * @return OldArticleExtraFieldI18n
     */
    public function setCulture($culture)
    {
        $this->culture = $culture;

        return $this;
    }

    /**
     * Get culture
     *
     * @return string 
     */
    public function getCulture()
    {
        return $this->culture;
    }

    /**
     * Set pdfFileLabel
     *
     * @param string $pdfFileLabel
     * @return OldArticleExtraFieldI18n
     */
    public function setPdfFileLabel($pdfFileLabel)
    {
        $this->pdfFileLabel = $pdfFileLabel;

        return $this;
    }

    /**
     * Get pdfFileLabel
     *
     * @return string 
     */
    public function getPdfFileLabel()
    {
        return $this->pdfFileLabel;
    }

    /**
     * Set pdfFile
     *
     * @param string $pdfFile
     * @return OldArticleExtraFieldI18n
     */
    public function setPdfFile($pdfFile)
    {
        $this->pdfFile = $pdfFile;

        return $this;
    }

    /**
     * Get pdfFile
     *
     * @return string 
     */
    public function getPdfFile()
    {
        return $this->pdfFile;
    }

    /**
     * Set externalFileLabel
     *
     * @param string $externalFileLabel
     * @return OldArticleExtraFieldI18n
     */
    public function setExternalFileLabel($externalFileLabel)
    {
        $this->externalFileLabel = $externalFileLabel;

        return $this;
    }

    /**
     * Get externalFileLabel
     *
     * @return string 
     */
    public function getExternalFileLabel()
    {
        return $this->externalFileLabel;
    }

    /**
     * Set externalFile
     *
     * @param string $externalFile
     * @return OldArticleExtraFieldI18n
     */
    public function setExternalFile($externalFile)
    {
        $this->externalFile = $externalFile;

        return $this;
    }

    /**
     * Get externalFile
     *
     * @return string 
     */
    public function getExternalFile()
    {
        return $this->externalFile;
    }

    /**
     * Set source
     *
     * @param string $source
     * @return OldArticleExtraFieldI18n
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string 
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set articleDate
     *
     * @param \DateTime $articleDate
     * @return OldArticleExtraFieldI18n
     */
    public function setArticleDate($articleDate)
    {
        $this->articleDate = $articleDate;

        return $this;
    }

    /**
     * Get articleDate
     *
     * @return \DateTime 
     */
    public function getArticleDate()
    {
        return $this->articleDate;
    }
}
