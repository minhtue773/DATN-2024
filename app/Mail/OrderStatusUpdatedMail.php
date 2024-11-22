<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderStatusUpdatedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $order;
    public $statusMessage;

    public function __construct($order, $statusMessage)
    {
        $this->order = $order;
        $this->statusMessage = $statusMessage;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Cập nhật đơn hàng',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.order_status_updated', // Chỉ định view chứa nội dung email
        );
    }
}
