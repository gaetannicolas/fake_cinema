<?php

namespace App\Controller;



use App\Entity\Films;
use App\Entity\Screenings;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends AbstractController
{
  /**
   * @Route("/", name="home")
   * @param EntityManagerInterface $entityManager
   * @return Response
   */
  public function home(EntityManagerInterface $entityManager)
  {
    $films = $entityManager->getRepository(Films::class)->findAll();
    $screenings = $entityManager->getRepository(Screenings::class)->findAll();
    return $this->render('home.html.twig', array(
      'films' => $films,
      'screenings' => $screenings
    ));
  }

  /**
   * @Route("/film/{id}", name="filmDetail")
   * @param EntityManagerInterface $entityManager
   * @return Response
   */
  public function filmDetail($id, EntityManagerInterface $entityManager)
  {
    $film = $entityManager->getRepository(Films::class)->findOneById($id);
    $sessions = $entityManager->getRepository(Screenings::class)->findAll();
    return $this->render('film.html.twig', array(
      'film' => $film,
      'screenings' => $sessions
    ));
  }
}
