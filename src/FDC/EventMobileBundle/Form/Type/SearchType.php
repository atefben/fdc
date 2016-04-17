<?php

namespace FDC\EventMobileBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class SearchType
 * @package FDC\EventMobileBundle\Form\Type
 *
 */

class SearchType extends AbstractType
{
    private $translator;
    private $searchTerm;

    /**
     * @param $translator
     * @param $searchTerm
     */
    public function __construct($translator, $searchTerm)
    {
        $this->translator = $translator;
        $this->searchTerm = $searchTerm;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($this->searchTerm !== null) {
            $builder
                ->add('search',  new TextType() , array(
                    'attr' => array(
                        'placeholder' => $this->searchTerm
                    ),
                    'label' => false
                ));
        }
        else {
            $builder
                ->add('search',  new TextType() , array(
                    'attr' => array(
                        'placeholder' => $this->translator->trans('header.search.input.entrezrecherche')
                    ),
                    'label' => false
                ));
        }

    }


    /**
     * @return string
     */

    public function getName()
    {
        return 'search';
    }
}