<?php

namespace App\Mail;

use App\Models\Booking;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingCancelMail extends Mailable
{
    use Queueable, SerializesModels;
    public Booking $booking;
    public Transaction $transaction;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Booking $booking, Transaction $transaction)
    {
        $this->booking = $booking;
        $this->transaction = $transaction;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Thông báo hủy đặt phòng #' . $this->booking->booking_code,
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
            view: 'emails.booking_cancel',    
            with: [
                'booking' => $this->booking,
                'transaction' => $this->transaction
            ],
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
