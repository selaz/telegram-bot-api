<?php

namespace Selaz\Telegram\Entity;

class Location extends Entity {

    /** @var float */
    protected $longitude;
    
    /** @var float */
    protected $latitude;

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
