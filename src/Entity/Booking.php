<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 */
class Booking
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Screenings", inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $screeningId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getScreeningId(): ?Screenings
    {
        return $this->screeningId;
    }

    public function setScreeningId(?Screenings $screeningId): self
    {
        $this->screeningId = $screeningId;

        return $this;
    }

  public function __toString()
  {
    // TODO: Implement __toString() method.
    return 'Booking'.$this->id;
  }
}
