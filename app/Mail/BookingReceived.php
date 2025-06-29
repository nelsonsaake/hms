<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingReceived extends Mailable
{
    use Queueable, SerializesModels; 

    /**
     * Create a new message instance.
     */
    public function __construct(public Booking $reservation)
    { 
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Booking Has Been Received – Awaiting Confirmation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    { 
        return new Content(
            view: 'emails.booking_received',  
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
