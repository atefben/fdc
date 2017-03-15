<?php

namespace FDC\CourtMetrageBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Eko\FeedBundle\Item\Writer\RoutedItemInterface;

/**
 * CcmMediaAudio
 *
 * @ORM\Table(name="ccm_media_audio")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class CcmMediaAudio extends CcmMedia implements RoutedItemInterface
{
    use Translatable;

    public static $localeTemp = 'fr';

    /**
     * @var CcmMediaImage
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaImage", cascade={"persist"})
     */
    protected $image;

    /**
     * CcmMediaAudio constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Set image
     *
     * @param CcmMediaImage $image
     * @return CcmMediaAudio
     */
    public function setImage(CcmMediaImage $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return CcmMediaImage
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * This method returns feed item title.
     *
     * @abstract
     *
     * @return string
     */
    public function getFeedItemTitle(){
        return array('title' => $this->findTranslationByLocale(static::$localeTemp)->getTitle());
    }

    /**
     * This method returns feed item description (or content).
     *
     * @abstract
     *
     * @return string
     */
    public function getFeedItemDescription(){
        return array('description' => 'description');
    }

    /**
     * This method returns the name of the route.
     *
     * @abstract
     *
     * @return string
     */
    public function getFeedItemRouteName(){
        return 'ccm_event_news_getaudios';
    }

    /**
     * This method returns the parameters for the route.
     *
     * @abstract
     *
     * @return array
     */
    public function getFeedItemRouteParameters(){
        return null;
    }

    /**
     * This method returns the anchor to be appended on this item's url.
     *
     * @abstract
     *
     * @return string The anchor, without the "#"
     */
    public function getFeedItemUrlAnchor() {
        return 'aid='.$this->id;
    }

    /**
     * This method returns item publication date.
     *
     * @abstract
     *
     * @return array
     */
    public function getFeedItemPubDate() {
        return array('date' => $this->getUpdatedAt());
    }

}
