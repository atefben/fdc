<?php

namespace FDC\CorporateBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class SearchType
 * @package FDC\CorporateBundle\Form\Type
 *
 */
class SearchType extends AbstractType {
    private $translator;

    /**
     * @param $translator
     * @param $searchTerm
     */
    public function __construct($translator, $searchTerm, $professions, $prizes, $selections) {
        $this->translator = $translator;
        $this->searchTerm = $searchTerm;
        $this->professions = $professions;
        $this->prizes = $prizes;
        $this->selections = $selections;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->setMethod('GET')
            ->add('search',  new TextType() , array(
                'attr' => array(
                    'placeholder' => $this->translator->trans('search.form.entrezrecherche', array(), 'FDCCorporateBundle')
                ),
                'label' => false,
                'required' => false
            ))
            ->add('news', 'checkbox', array(
                'label'    => $this->translator->trans('search.form.news', array(), 'FDCCorporateBundle'),
                'required' => false,
            ))
            ->add('photos', 'checkbox', array(
                'label'    => $this->translator->trans('search.form.photos', array(), 'FDCCorporateBundle'),
                'required' => false,
            ))
            ->add('videos', 'checkbox', array(
                'label'    => $this->translator->trans('search.form.videos', array(), 'FDCCorporateBundle'),
                'required' => false,
            ))
            ->add('audios', 'checkbox', array(
                'label'    => $this->translator->trans('search.form.audios', array(), 'FDCCorporateBundle'),
                'required' => false,
            ))
            ->add('events', 'checkbox', array(
                'label'    => $this->translator->trans('search.form.events', array(), 'FDCCorporateBundle'),
                'required' => false,
            ))
            ->add('artists', 'checkbox', array(
                'label'    => $this->translator->trans('search.form.artists', array(), 'FDCCorporateBundle'),
                'required' => false,
            ))
            ->add('movies', 'checkbox', array(
                'label'    => $this->translator->trans('search.form.movies', array(), 'FDCCorporateBundle'),
                'required' => false,
            ))
            ->add('professions', 'choice', array(
                'choices'  => $this->professions,
                'choices_as_values' => true,
                'multiple' => true,
                'expanded' => true
            ))
            ->add('prizes', 'choice', array(
                'choices'  => $this->prizes,
                'choices_as_values' => true,
                'multiple' => true,
                'expanded' => true
            ))
            ->add('selections', 'choice', array(
                'choices'  => $this->selections,
                'choices_as_values' => true,
                'multiple' => true,
                'expanded' => true
            ))
            ->add('genres', 'choice', array(
                'choices'  => array(
                    $this->translator->trans('search.form.gender.male', array(), 'FDCCorporateBundle') => 'M',
                    $this->translator->trans('search.form.gender.female', array(), 'FDCCorporateBundle') => 'F'
                ),
                'choices_as_values' => true,
                'multiple' => true,
                'expanded' => true
            ))
            ->add('formats', 'choice', array(
                'choices'  => array(
                    $this->translator->trans('search.form.format.longmetrage', array(), 'FDCCorporateBundle') => 'longmetrage',
                    $this->translator->trans('search.form.format.courtmetrage', array(), 'FDCCorporateBundle') => 'courtmetrage'
                ),
                'choices_as_values' => true,
                'multiple' => true,
                'expanded' => true
            ))
            ->add('yearStart', 'hidden', array(
                'data' => '1946',
            ))
            ->add('yearEnd', 'hidden', array(
                'data' => '2017',
            ))
            ->add('artistCountry',  new TextType() , array(
                'attr' => array(
                    'class'       => 'country',
                    'placeholder' => $this->translator->trans('search.form.country', array(), 'FDCCorporateBundle')
                ),
                'label' => false,
                'required' => false
            ))
            ->add('movieCountry',  new TextType() , array(
                'attr' => array(
                    'class'       => 'country',
                    'placeholder' => $this->translator->trans('search.form.country', array(), 'FDCCorporateBundle')
                ),
                'label' => false,
                'required' => false
            ))
        ;

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'allow_extra_fields' => true,
                'csrf_protection' => false
            )
        );
    }

    /**
     * @return string
     */
    public function getName() {
        return '';
    }
}