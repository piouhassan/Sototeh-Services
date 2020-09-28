<?php


namespace Akuren\Mail;


use AkConfig\config\Config;
use App\Views\View;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;
use Twig_Environment;
use Twig_Loader_Filesystem;

class Mail
{

        private  $subjet;
        private  $toMail;
        private $message;
        private $params;

    /**
     * @param mixed $subjet
     * @return Mail
     */
    public function setSubjet($subjet)
    {
        $this->subjet = $subjet;
        return $this;
    }

    /**
     * @param mixed $toMail
     * @return Mail
     */
    public function setToMail($toMail)
    {
        $this->toMail = $toMail;
        return $this;
    }

    /**
     * @param $message
     * @param array $params
     * @return $this
     */
    public function setMessage($message, array $params = [])
    {
        $this->message = $message.".twig";
        $this->params = compact("params");
        return $this;
    }
    /**
     * @return Swift_SmtpTransport
     */

    private function transport ()
    {
        $transport = (new Swift_SmtpTransport(Config::Mail_Host, Config::Mail_Transport,"tls"))
            ->setUsername(Config::Mail_setFromMail)
            ->setPassword('marcelmihesso9348')
        ;
        return $transport;
   }

    public static  function send(){
        return (new Mail());
    }

    public function exec(){
        $mailer = new Swift_Mailer((new Mail())->transport());
        $twig = new  Twig_Environment( new Twig_Loader_Filesystem(dirname(dirname(__DIR__)).'/common/mail'),[]);
        $messages = (new Swift_Message($this->subjet))
            ->setFrom([Config::Mail_setFromMail => Config::Mail_setFromName])
            ->setTo([$this->toMail])
            ->setBody($twig->render($this->message,$this->params),'text/html');

          return $mailer->send($messages);
    }



    /**
     * @param mixed $message
     */



}