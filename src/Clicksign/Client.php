<?php

namespace Clicksign;

use Clicksign\ClientBase;
use Clicksign\Service;
use Clicksign\Services\Batches;
use Clicksign\Services\Documents;
use Clicksign\Services\Hooks;

class Client extends ClientBase
{
    public $batches;
    public $documents;
    public $hooks;

    public function __construct()
    {
        $this->batches = new Batches($this);
        $this->documents = new Documents($this);
        $this->hooks = new Hooks($this);
    }
}
