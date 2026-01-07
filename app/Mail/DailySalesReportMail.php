<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class DailySalesReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Collection $items) {}

    public function build()
    {
        return $this
            ->subject('Daily Sales Report')
            ->view('emails.daily-sales-report')
            ->with([
                'items' => $this->items,
            ]);
    }
}
