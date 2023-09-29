<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade as PDF;

class Invoice_mail extends Mailable
{
    use Queueable, SerializesModels;

    public $pdf;
    public $pdfFileName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pdf, $pdfFileName)
    {
        $this->pdf = $pdf;
        $this->pdfFileName = $pdfFileName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.invoice.mails.invoice_client')
                    ->attachData($this->pdf->output(), $this->pdfFileName)
                    ->subject('New invoice');
    }
}
