<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BudgetExceededMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $totalExpenses;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $totalExpenses)
    {
        //
        $this->user = $user;
        $this->totalExpenses = $totalExpenses;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
  
    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function build()
    {
        return $this->subject('Budget Exceeded Alert')
                    ->view('emails.budget_exceeded');
    }
  

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
