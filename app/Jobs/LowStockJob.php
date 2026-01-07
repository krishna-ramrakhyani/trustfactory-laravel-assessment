<?php

namespace App\Jobs;

use App\Mail\LowStockMail;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class LowStockJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function __construct(public Product $product) {}

    public function handle()
    {
        Mail::to('admin@dummy.com')->send(
            new LowStockMail($this->product)
        );
    }
}

