<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Films;
use App\Form\BookingType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\BookingRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\FormatManager\FormFormat;

class BookingController extends AbstractController
{
  /**
   * @Route("/book", name="book")
   * @param Request $request
   * @param EntityManagerInterface $manager
   * @return Response
   * @var Films $film
   */

  public function addBooking(Request $request, EntityManagerInterface $manager, FormFormat $format): Response
  {
    $film = $manager->getRepository(Films::class)->findOneById($request->get('id'));
    $booking = new Booking();
    $booking->setUserId($this->getUser());
    $screenings = $manager->getRepository(Films::class)->find($request->get('id'))->getScreenings();
    $form = $this->createForm(BookingType::class, $booking, [
      'screening'=> $format->formatScreeningsForBookingForm($screenings)
    ])->handleRequest($request);


    if ($form->isSubmitted() && $form->isValid()) {
      $manager->persist($booking);
      $manager->flush();
      return $this->redirectToRoute('bookings');
    }
    return $this->render('booking/new.html.twig', [
      'bookingForm' => $form->createView(),
      'film' => $film
    ]);
  }

  /**
   * @Route("/bookings", name="bookings")
   * @param BookingRepository $bookingRepository
   * @return Response
   */
  public function bookings(BookingRepository $bookingRepository)
  {
    $bookings = $bookingRepository->findBy(["userId" => $this->getUser()]);

    return $this->render('booking/bookings.html.twig', array(
      'bookings' => $bookings
    ));
  }

  /**
   * @Route("/deleteBooking/{id}", name="deleteBooking")
   * @ParamConverter("id", class=Booking::class)
   * @param Booking $booking
   * @param EntityManagerInterface $entityManager
   * @return \Symfony\Component\HttpFoundation\RedirectResponse
   */
  public function deleteBooking(Booking $booking, EntityManagerInterface $entityManager)
  {
    $entityManager->remove($booking);
    $entityManager->flush();
    return $this->redirectToRoute('bookings');
  }

}
