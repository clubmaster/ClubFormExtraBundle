<?php

namespace Club\FormExtraBundle\Helper;

class FlashHelper
{
    private $session;
    private $trans;
    private $log;

    public function __construct($session, $trans, $log)
    {
        $this->session = $session;
        $this->trans = $trans;
        $this->log = $log;
    }

    public function addInfo($message)
    {
        $this->session->getFlashBag()->add('info', $message);
    }

    public function addWarning($message)
    {
        $this->session->getFlashBag()->add('warning', $message);
    }

    public function addNotice($message=null)
    {
        if (!strlen($message)) {
            $message = $this->trans->trans('Your changes are saved.');
        }

        $this->session->getFlashBag()->add('notice', $message);
    }

    public function addError($message=null)
    {
        if (!strlen($message)) {
            $message = $this->trans->trans('Operation did not finish, an error occur.');
        }

        $this->session->getFlashBag()->add('error', $message);
        $this->log->error($message);
    }
}
