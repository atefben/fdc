<?php

namespace Base\CoreBundle\Twig\Extension;

use \Twig_Extension;

/**
 * TransFallbackExtension class.
 *
 * @extends Twig_Extension
 * @author  Antoine Mineau
 * @company Ohwee
 */
class IconCorpoExtension extends Twig_Extension
{
    private $localeFallback;

    private $requestStack;

    public function __construct($localeFallback, $requestStack)
    {
        $this->localeFallback = $localeFallback;
        $this->requestStack = $requestStack;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('icon_corpo', array($this, 'iconCorpoTransform')),
        );
    }

    public function iconCorpoTransform($object)
    {
        if ($object) {
            $datas = array(
                'icon_voiture' => 'icon-car-fill',
                'icon_train' => 'icon-train',
                'icon_avion' => 'icon-plane',
                'icon_bus' => 'icon-bus',
                'icon_taxi' => 'icon-taxi-fill',
                'icon_wifi' => 'icon-wifi',
                'icon_enregistreur' => 'icon-camera-photo',
                'icon_salle-presse' => 'icon-mike-fill',
                'icon_casier' => 'icon-books',
                'icon_plateau-tv' => 'icon-tv',
                'icon_zone-media' => 'icon-stool',
                'icon_transport' => 'icon-bus-fill',
                'icon_divers' => 'icon-map',
                'icon_se-rendre-a-cannes' => 'icon-car',
                'icon_a-votre-service' => 'icon-marker-black',
                'icon_hebergement' => 'icon-lodging',
                'icon_informations' => "icon-information",
                'icon_horaires' => 'icon-hours',
                'icon_acces' => 'icon-card-access',
                'icon_les-differents-types-dacces' => 'icon-documen-acces',
                'icon_les-salles-de-projections' => 'icon-camera-round',
                'icon_les-bonnes-pratiques' => 'icon-check',
                'icon_point-infos' => 'icon-user-fill',
                'icon_consignes' => 'icon-bag',
                'icon_objets-trouves' => 'icon-wen-fill',
                'icon_n-urgence' => 'icon-emergency',
            );

            if(isset($datas[$object])) {
                return $datas[$object];
            } else {
                return $object;
            }

        }

        return '';
    }


    /**
     * getName function.
     *
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'icon_corpo_extension';
    }
}