<?php

require_once(__DIR__ . '/ClicksignClientBase.php');
require_once(__DIR__ . '/services/ClicksignBatches.php');
require_once(__DIR__ . '/services/ClicksignDocuments.php');
require_once(__DIR__ . '/services/ClicksignHooks.php');

class ClicksignClient extends ClicksignClientBase
{

    public $batches;
    public $documents;
    public $hooks;

    public function __construct()
    {
        $this->batches = new ClicksignBatches($this);
        $this->documents = new ClicksignDocuments($this);
        $this->hooks = new ClicksignHooks($this);
    }
}
