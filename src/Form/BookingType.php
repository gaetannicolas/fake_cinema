<?php

namespace App\Form;

use App\Entity\Screenings;
use function Couchbase\defaultDecoder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{

  public function __construct(EntityManagerInterface $em)
  {
    $this->em = $em;

  }
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('screeningId', ChoiceType::class, [
      'choices' => $builder->getOption('screening')
    ]);
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(['screening'=>null]);
  }
}
