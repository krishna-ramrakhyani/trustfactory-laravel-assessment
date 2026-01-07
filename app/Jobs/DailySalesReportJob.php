<?php

namespace App\Jobs;

use App\Mail\DailySalesReportMail;
use App\Models\CartItem;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable; // Added
use Illuminate\Queue\InteractsWithQueue; // Added
use Illuminate\Queue\SerializesModels; // Added
use Illuminate\Support\Facades\Mail;

class DailySalesReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $items = CartItem::whereDate('created_at', today())->with('product')->get();

        Mail::to('admin@dummy.com')->send(
            new DailySalesReportMail($items)
        );
    }
}
