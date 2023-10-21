<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Gallery\GalleryImage;

class LinkDownload extends Mailable {

    use Queueable,
        SerializesModels;

    public $post;
    public $title;

    public function __construct($title, $post) {
        $this->title = $title;
        $this->post = $post;
    }

    public function envelope() {
        return new Envelope(
                subject: 'Link Download',
        );
    }

    public function content() {
        return new Content(
                view: 'email',
        );
    }

    public function attachments() {
        return [];
    }

}
