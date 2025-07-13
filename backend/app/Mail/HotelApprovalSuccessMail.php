<?php

namespace App\Mail;

use App\Models\Hotel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class HotelApprovalSuccessMail extends Mailable
{
    use Queueable, SerializesModels;
    public Hotel $hotel;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Hotel $hotel) {
        $this->hotel = $hotel;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Chúc mừng! Khách sạn đã được phê duyệt trên Roomix',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.hotelApprovalSuccess',
            with:[
                'hotel' => $this->hotel
            ]
        );
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
