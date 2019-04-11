<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ScreeningsRepository")
 */
class Screenings
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Films", inversedBy="screenings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $filmId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Room", inversedBy="screenings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $roomId;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Booking", mappedBy="screeningId", orphanRemoval=true)
     */
    private $bookings;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTimeInterface $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getFilmId(): ?Films
    {
        return $this->filmId;
    }

    public function setFilmId(?Films $filmId): self
    {
        $this->filmId = $filmId;

        return $this;
    }

    public function getRoomId(): ?Room
    {
        return $this->roomId;
    }

    public function setRoomId(?Room $roomId): self
    {
        $this->roomId = $roomId;

        return $this;
    }

    /**
     * @return Collection|Booking[]
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings[] = $booking;
            $booking->setScreeningId($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->contains($booking)) {
            $this->bookings->removeElement($booking);
            // set the owning side to null (unless already changed)
            if ($booking->getScreeningId() === $this) {
                $booking->setScreeningId(null);
            }
        }

        return $this;
    }
}
