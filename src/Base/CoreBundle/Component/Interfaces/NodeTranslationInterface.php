<?php
namespace Base\CoreBundle\Component\Interfaces;

use Base\CoreBundle\Entity\Node;

/**
 * Interface NodeTranslationInterface
 * @package Base\CoreBundle\Component\Interfaces
 */
interface NodeTranslationInterface
{

    /**
     * @return int
     */
    public function getId();

    /**
     * Set title
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title);

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set introduction
     *
     * @param string $introduction
     * @return $this
     */
    public function setIntroduction($introduction);

    /**
     * Get introduction
     *
     * @return string
     */
    public function getIntroduction();

    /**
     * Set slug
     *
     * @param string $slug
     * @return $this
     */
    public function setSlug($slug);

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug();

    /**
     * Set status
     *
     * @param int $status
     * @return $this
     */
    public function setStatus($status);

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus();

    /**
     * Set locale
     *
     * @param string $locale
     * @return $this
     */
    public function setLocale($locale);

    /**
     * Get locale
     *
     * @return string
     */
    public function getLocale();

    /**
     * Set translatable
     *
     * @param Node $translatable
     * @return $this
     */
    public function setTranslatable($translatable);

    /**
     * Get translatable
     *
     * @return Node
     */
    public function getTranslatable();
}