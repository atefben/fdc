<?php

namespace FDC\CourtMetrageBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Collection;

class ShareEmailType extends AbstractType
{
    private $translator;
    private $artist;

    /**
     * ShareEmailType constructor.
     * @param $translator
     * @param null $artist
     */
    public function __construct($translator, $artist = null)
    {
        $this->translator = $translator;
        $this->artist = $artist;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'text', array(
                'pattern' => '^([\w+-.%]+@[\w-.]+\.[A-Za-z]{2,4},?)+$',
                'attr' => array(
                    'placeholder' => $this->translator->trans('ccm.sharemail.form.placeholder.email'),
                    'class'       => 'popin'
                ),
                'label' => false
            ))
            ->add('user', 'email', array(
                'attr' => array(
                    'placeholder' => $this->translator->trans('ccm.sharemail.form.placeholder.votreemail'),
                    'class'       => 'popin'
                ),
                'label' => false
            ))
            ->add('copy', new CheckboxType() , array(
                'attr' => array(
                    'class'       => 'popin',
                    'id'          => 'mail-copy',
                ),
                'data' => false,
                'required' => false,
                'label' => 'M\'envoyez une copie par email'
            ))
            ->add('message', 'textarea', array(
                'attr' => array(
                    'placeholder' => $this->translator->trans('ccm.sharemail.form.placeholder.message'),
                    'class'       => 'popin'
                ),
                'label' => false,
                'required' => false
            ))
            ->add('newsletter', new CheckboxType() , array(
                'attr' => array(
                    'class'       => 'popin'
                ),
                'data' => false,
                'required' => false,
                'label' => 'Je souhaite recevoir la newsletter du Festival de Cannes'
            ))
            ->add('section', 'hidden', array('label' => false))
            ->add('url', 'hidden', array('label' => false))
            ->add('detail', 'hidden', array('label' => false))
            ->add('title', 'hidden', array('label' => false))
            ->add('description', 'hidden', array('label' => false));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $collectionConstraint = new Collection(array(
           'email' => array(
               new NotBlank(array('message' => $this->translator->trans('ccm.contact.form.errors.email'))),
               new Email(array('message' => $this->translator->trans('contact.form.errors.email')))
           ),
           'user' => array(
               new NotBlank(array('message' => $this->translator->trans('ccm.contact.form.errors.email'))),
               new Email(array('message' => $this->translator->trans('ccm.contact.form.errors.email')))
           ),
           'message' => array(),
           'copy'=> array(),
           'newsletter' => array(),
           'section' => array(),
           'detail' => array(),
           'title' => array(),
           'description' => array(),
           'url' => array(),
        ));
        $defaults = array(
            'csrf_protection' => false,
            'constraints' => $collectionConstraint,
            'translation_domain' => 'messages'
        );
        if ($this->artist) {
            $defaults['attr'] = array(
                'artiste' => $this->artist,
            );
        }
        $resolver->setDefaults($defaults);


    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'share_email_ccm';
    }
}
