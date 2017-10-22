<?php
namespace AppBundle\Toaster;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Created by PhpStorm.
 * User: jona
 * Date: 22/10/17
 * Time: 11:24
 */
class FlashbagToast
{
    
    const SUCCESS = 'toastSuccess';
    const ERROR = 'toastError';
    /**
     * @var Session
     */
    private $session;

    /**
     * FlashbagToast constructor.
     * @param $session
     */
    public function __construct($session)
    {
        $this->session = $session;
    }
    
    public function addSuccess($message){
        $this->session->getFlashBag()->add(self::SUCCESS,$message);
    }
    public function addError($message){
        $this->session->getFlashBag()->add(self::ERROR,$message);
    }


}