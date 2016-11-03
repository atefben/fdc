<?php

namespace FDC\CorporateBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
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
            ->add('search',  new TextType() , array(
                'attr' => array(
                    'value'       => $this->searchTerm,
                    'placeholder' => $this->translator->trans('header.search.input.entrezrecherche')
                ),
                'label' => false
            ))
            ->add('news', 'checkbox', array(
                'label'    => $this->translator->trans('header.search.input.news'),
                'required' => false,
            ))
            ->add('photos', 'checkbox', array(
                'label'    => $this->translator->trans('header.search.input.photos'),
                'required' => false,
            ))
            ->add('videos', 'checkbox', array(
                'label'    => $this->translator->trans('header.search.input.videos'),
                'required' => false,
            ))
            ->add('audios', 'checkbox', array(
                'label'    => $this->translator->trans('header.search.input.audios'),
                'required' => false,
            ))
            ->add('events', 'checkbox', array(
                'label'    => $this->translator->trans('header.search.input.events'),
                'required' => false,
            ))
            ->add('artists', 'checkbox', array(
                'label'    => $this->translator->trans('search.form.artists'),
                'required' => false,
            ))
            ->add('movies', 'checkbox', array(
                'label'    => $this->translator->trans('search.form.movies'),
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
                    $this->translator->trans('search.form.gender.male') => 'male',
                    $this->translator->trans('search.form.gender.female') => 'female'
                ),
                'choices_as_values' => true,
                'multiple' => true,
                'expanded' => true
            ))
            ->add('formats', 'choice', array(
                'choices'  => array(
                    $this->translator->trans('search.form.format.longmetrage') => 'longmetrage',
                    $this->translator->trans('search.form.format.courtmetrage') => 'courtmetrage'
                ),
                'choices_as_values' => true,
                'multiple' => true,
                'expanded' => true
            ))
            ->add('formats', 'choice', array(
                'choices'  => array(
                    $this->translator->trans('search.form.format.longmetrage') => 'longmetrage',
                    $this->translator->trans('search.form.format.courtmetrage') => 'courtmetrage'
                ),
                'choices_as_values' => true,
                'multiple' => true,
                'expanded' => true
            ))
            ->add('year-start', 'hidden', array(
                'data' => '1946',
            ))
            ->add('year-end', 'hidden', array(
                'data' => '2016',
            ));

    }

    /**
     * @return string
     */
    public function getName() {
        return 'search';
    }
}