<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\CustomerPage\Form;

use Spryker\Yves\Kernel\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
/**
 * @method \Pyz\Yves\CustomerPage\CustomerPageConfig getConfig()
 */
class KidsBirthdayForm extends AbstractType
{
  
     /**
     * @var string
     */

    /**
     * @var string
     */
    public const FIELD_NAME = 'name';

    /**
     * @var string
     */
    public const FIELD_GENDER = 'gender';

    /**
     * @var string
     */
    public const FIELD_DOB = 'dob';



    /**
     * @var string
     */
    public const OPTION_GENDER_CHOICES = 'gender_choices';

    /**
     * @var string
     */
    protected const VALIDATION_NOT_BLANK_MESSAGE = 'validation.not_blank';

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'addressForm';
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired(self::OPTION_GENDER_CHOICES);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this
            ->addNameField($builder, $options)
            ->addGenderField($builder, $options)
            ->addDOBField($builder,$options);
         
    }

     /**
     * @param array $options
     *
     * @return \Symfony\Component\Validator\Constraints\NotBlank
     */
    protected function createNotBlankConstraint(array $options): NotBlank
    {
        return new NotBlank(['message' => static::VALIDATION_NOT_BLANK_MESSAGE]);
    }

 
    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return $this
     */
    protected function addNameField(FormBuilderInterface $builder, array $options)
    {
        $builder->add(self::FIELD_NAME, TextType::class, [
            'label' => 'customer.kids-birthday.name',
            'required' => true,
            'trim' => true,
            'constraints' => [
                $this->createNotBlankConstraint($options),
            ],
        ]);

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return $this
     */
    protected function addGenderField(FormBuilderInterface $builder, array $options)
    {
        $builder->add(self::FIELD_GENDER, ChoiceType::class, [
            'label' => 'customer.kids-birthday.gender',
            'required' => true,
            'trim' => true,
            'constraints' => [
                $this->createNotBlankConstraint($options),
            ],
            'choices' => array_flip($options[self::OPTION_GENDER_CHOICES]),
            
        ]);

        return $this;
    }

   

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return $this
     */
    protected function addDOBField(FormBuilderInterface $builder, array $options)
    {
        $builder->add(self::FIELD_DOB, DateType::class, [
            'label' => 'customer.kids-birthday.dob',
            'required' => true,
            'trim' => true,
            'constraints' => [
                $this->createNotBlankConstraint($options),
            ],
            
        ]);

        return $this;
    }

    

    
}
