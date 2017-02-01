<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * ServiceWidgetProductCollection
 *
 * @ORM\Table(name="mdf_service_widget_product_collection")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class ServiceWidgetProductCollection
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
     * @ORM\ManyToOne(targetEntity="ServiceWidgetProduct", inversedBy="productsCollection")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="ServiceWidget", inversedBy="productCollections")
     * @ORM\JoinColumn(name="service_widget_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $serviceWidget;

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
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $products
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     * @return mixed
     */
    public function getServiceWidget()
    {
        return $this->serviceWidget;
    }

    /**
     * @param mixed $serviceWidget
     */
    public function setServiceWidget($serviceWidget)
    {
        $this->serviceWidget = $serviceWidget;
    }
    

    /**
     * Set position
     *
     * @param integer $position
     * @return GalleryMdfMedia
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }
}
