<?php

namespace App\Mail;

use App\Models\Hotel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class HotelApprovalRejectedMail extends Mailable
{
    use Queueable, SerializesModels;
    public $reason;
    public Hotel $hotel;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reason, Hotel $hotel)
    {
        $this->reason = $reason;
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
            subject: 'Phản hồi từ Roomix: Yêu cầu đăng ký khách sạn bị từ chối',
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
            view: 'emails.hotelApprovalRejected',
            with: [
                'reason' => $this->reason,
                'hotel' =>$this->hotel
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
