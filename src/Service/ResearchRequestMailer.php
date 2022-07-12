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
        $email = new Email();
        if (is_string($this->parameters->get('mailer_from'))) {
            $email->from($this->parameters->get('mailer_from'));
        }
        if (is_string($this->parameters->get('mailer_to'))) {
            $email->to($this->parameters->get('mailer_to'));
        }
        $email->subject('A new research request is available !');
        $email->html(
            '<h1>Hello there !</h1>
            <p>A new research request is available !</p>
            <p>Best Regards</p>'
        );
                $this->mailer->send($email);
    }

    public function researchPlanSendMail(): void
    {
        $email = new Email();
        if (is_string($this->parameters->get('mailer_from'))) {
            $email->from($this->parameters->get('mailer_from'));
        }
        if (is_string($this->parameters->get('mailer_to'))) {
            $email->to($this->parameters->get('mailer_to'));
        }
        $email->subject('A new research plan has been sent !');
        $email->html(
            '<h1>Hello there !</h1>
            <p>This mail confirm that you sent a new research
            plan to your colaborator !</p>
            <p>Best Regards</p>'
        );
                $this->mailer->send($email);
    }
}
