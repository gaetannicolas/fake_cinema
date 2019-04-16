<?php

namespace App\Form;

use App\Entity\Screenings;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class BookingType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('screeningId', EntityType::class, [
      'class' => Screenings::class,
      'choice_label' => function ($screeningId) {
        return $screeningId;
      }
    ]);
  }
}
