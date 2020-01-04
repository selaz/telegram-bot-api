<?php

namespace Selaz\Telegram\Entity;

class Location {

    /** @var float */
    private $longitude;
    
    /** @var float */
    private $latitude;

    public function setLatitude(?float $latitude): void {
        $this->latitude = $latitude;
    }

    public function getLatitude(): ?float {
        return $this->latitude;
    }

    public function setLongitude(?float $longitude): void {
        $this->longitude = $longitude;
    }

    public function getLongitude(): ?float {
        return $this->longitude;
    }
}
