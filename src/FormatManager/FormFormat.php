<?php

namespace App\FormatManager;

class FormFormat
{
  public function formatScreeningsForBookingForm($screenings)
  {
    $screeningsChoices = array();
    foreach ($screenings as $screening) {
      $screeningsChoices[$screening->__toString()] = $screening;
    }
    return $screeningsChoices;
  }
}
