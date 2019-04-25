<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Screenings;
use App\Form\BookingType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;
use App\Repository\BookingRepository;

class BookingController extends Controller
{
  /**
   * @Route("/book", name="book")
   * @param Request $request
   * @return Response
   */
  public function addBooking(Request $request, EntityManagerInterface $manager): Response
  {
    $booking = new Booking();
    $booking->setUserId($this->getUser());
    $form = $this->createForm(BookingType::class, $booking)->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $manager->persist($booking);
      $manager->flush();
      return $this->redirectToRoute('bookings');
    }
    return $this->render('booking/new.html.twig', [
      'bookingForm' => $form->createView(),
    ]);
  }

  /**
   * @Route("/bookings", name="bookings")
   * @param EntityManagerInterface $entityManager
   * @return Response
   */
  public function bookings(BookingRepository $bookingRepository)
  {
    $bookings = $bookingRepository->findBy(["userId" => $this->getUser()]);

    return $this->render('booking/bookings.html.twig', array(
      'bookings' => $bookings
    ));
  }
}
