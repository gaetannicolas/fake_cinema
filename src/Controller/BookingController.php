<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\BookingType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

class BookingController extends Controller
{

  private $security;

  public function __construct(Security $security)
  {
    $this->security = $security;
  }

  /**
   * @Route("/book", name="book")
   * @param Request $request
   * @return Response
   */
  public function addBooking(Request $request): Response
  {
    $booking = new Booking();
    $form = $this->createForm(BookingType::class, $booking);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $booking->setUserId($this->getUser());
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($booking);
      $entityManager->flush();
      return $this->redirectToRoute('reservationSummary', ['id' => $booking->getId()]);
    }
    return $this->render('booking/new.html.twig', [
      'bookingForm' => $form->createView(),
    ]);
  }
}
