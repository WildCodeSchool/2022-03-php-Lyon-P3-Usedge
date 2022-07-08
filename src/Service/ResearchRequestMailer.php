<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ResearchRequestMailer
{
    private MailerInterface $mailer;
    private ParameterBagInterface $parameters;

    public function __construct(MailerInterface $mailer, ParameterBagInterface $parameters)
    {
        $this->mailer = $mailer;
        $this->parameters = $parameters;
    }

    public function researchRequestSendMail(): void
    {
        $email = (new Email())
                    ->from((string) $this->parameters->get('mailer_from'))
                    ->to((string) $this->parameters->get('mailer_to'))
                    ->subject('A new research request is available !')
                    ->html(
                        '<h1>Hello there !</h1>
                        <p>A new research request is available !</p>
                        <p>Best Regards</p>'
                    );
                $this->mailer->send($email);
    }
}
