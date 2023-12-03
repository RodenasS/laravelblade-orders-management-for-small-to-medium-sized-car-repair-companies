<?php

namespace App\Models;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'status',
        'estimated_start',
        'estimated_end',
        'client_id',
        'vehicle_id',
        'user_id',
        'vehicle_mileage',
        'total_ex_vat',
        'vat',
        'total_inc_vat',
        'description',
        'sms_notifications',
    ];


    protected static function boot()
    {
        parent::boot();

        static::created(function ($order) {
            $order->order_number = 'U' . str_pad($order->id, 6, '0', STR_PAD_LEFT);
            $order->save(); // Save the order again with the order_number
        });
    }

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where(function ($query) use ($filters) {
                $query->orWhere('order_number', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('date', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('status', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('description', 'like', '%' . $filters['search'] . '%')
                    ->orWhereHas('client', function ($subQuery) use ($filters) {
                        $subQuery->where('name', 'like', '%' . $filters['search'] . '%');
                    });
            });
        }
    }

    public function generatePDF()
    {
        // Load necessary data
        $this->load(['client', 'vehicle', 'items']);
        $companyInformation = CompanyInformation::firstOrFail();

        // Setup Dompdf
        $pdf = new Dompdf();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isRemoteEnabled', true);
        $pdf->setOptions($options);

        // Render the view
        $html = view('orders.pdf', [
            'order' => $this,
            'companyInformation' => $companyInformation
        ])->render();

        // Convert encoding and load HTML
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
        $pdf->loadHtml($html);

        // Generate PDF
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();

        // Save PDF to storage
        $fileName = 'order-' . $this->id . '.pdf';
        $output = $pdf->output();
        $filePath = 'public/pdf/' . $fileName;
        Storage::put($filePath, $output);

        // Return the storage path
        return Storage::path($filePath);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function images()
    {
        return $this->hasMany(OrderImage::class);
    }
    public function pdf()
    {
        return $this->hasOne(OrderPdf::class);
    }
}
