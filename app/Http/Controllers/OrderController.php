<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\CompanyInformation;
use App\Models\Order;
use App\Models\OrderImage;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Twilio\Rest\Client as TwilioClient;

class OrderController extends Controller
{
// Show all orders
    public function index(Request $request)
    {
        $query = Order::latest();

        $start_date = $request->start_date ?? Carbon::yesterday()->format('Y-m-d');
        $end_date = $request->end_date ?? Carbon::tomorrow()->format('Y-m-d');

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $orders = $query->paginate(12);

        return view('orders.index', compact('orders', 'start_date', 'end_date'), [
            'totalOrders' => $this->getTotalOrdersCount(),
            'ordersLast24Hours' => $this->getLast24HoursCount(),
            'ordersLast7Days' => $this->getLast7DaysCount(),
            'ordersLast31Days' => $this->getLast31DaysCount(),
        ]);
    }

    // Display a single order
    public function show(Order $order)
    {
        $order->load(['client', 'vehicle', 'items']);
        return view('orders.show', compact('order'));
    }

    // Show form to create a new order
    public function create()
    {
        $clients = Client::all();
        $vehicles = Vehicle::all();
        return view('orders.create', compact('clients', 'vehicles'));
    }

    // Store a new order
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'client_id' => 'nullable|exists:clients,id',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'vehicle_mileage' => 'integer',
            'status' => 'string',
            'estimated_start' => 'date',
            'estimated_end' => 'date',
            'items' => 'array',
            'items.*.product_code' => 'string',
            'items.*.product_name' => 'string',
            'items.*.quantity' => 'numeric',
            'items.*.unit' => 'string',
            'items.*.unit_price' => 'numeric',
            'description' => 'string',
        ]);

        // Additional fields for the order
        $formFields['date'] = now(); // Set the current date

        // Calculate totals
        $totalExVat = 0;
        $vatRate = 0.21; // VAT rate
        $formFields['items'] = $formFields['items'] ?? [];

        if (is_array($formFields['items']) && count($formFields['items']) > 0) {
            foreach ($formFields['items'] as &$item) {
                $item['total_ex_vat'] = $item['unit_price'] * $item['quantity'];
                $item['total_inc_vat'] = $item['total_ex_vat'] * (1 + $vatRate);
                $totalExVat += $item['total_ex_vat'];
            }

            $formFields['total_ex_vat'] = $totalExVat;
            $formFields['vat'] = $totalExVat * $vatRate;
            $formFields['total_inc_vat'] = $totalExVat * (1 + $vatRate);
        }

        // Create the order
        $formFields['user_id'] = auth()->id();
        $order = Order::create($formFields);

        // Create order items
        foreach ($formFields['items'] as $itemData) {
            $order->items()->create($itemData);
        }

        // Update vehicle mileage
        if (!empty($formFields['vehicle_id'])) {
            $vehicle = Vehicle::find($formFields['vehicle_id']);
            if ($vehicle) {
                $vehicle->update(['mileage' => $formFields['vehicle_mileage']]);
            }
        }

        // Handle images
        if ($request->has('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('images', 'public');
                $order->images()->create(['path' => $imagePath]);
            }
        }

        return redirect('/orders')->with('message', 'Order created successfully!');
    }

    public function edit(Order $order)
    {
        if (auth()->id() !== $order->user_id && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $order->load(['client', 'vehicle', 'items']);
        $clients = Client::all();
        $vehicles = Vehicle::all();
        return view('orders.edit', compact('order', 'clients', 'vehicles'));
    }

    // Update the order
    public function update(Request $request, Order $order)
    {
        $formFields = $request->validate([
            'client_id' => 'nullable|exists:clients,id',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'vehicle_mileage' => 'required|integer',
            'status' => 'required|string',
            'estimated_start' => 'date',
            'estimated_end' => 'date',
            'items' => 'required|array',
            'items.*.product_code' => 'required',
            'items.*.product_name' => 'required',
            'items.*.quantity' => 'required|numeric',
            'items.*.unit' => 'required',
            'items.*.unit_price' => 'required|numeric',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image',
            'description' => 'string',
        ]);

        $totalExVat = 0;
        $vatRate = 0.21; // VAT rate
        foreach ($formFields['items'] as &$item) {
            $item['total_ex_vat'] = $item['unit_price'] * $item['quantity'];
            $item['total_inc_vat'] = $item['total_ex_vat'] * (1 + $vatRate);
            $totalExVat += $item['total_ex_vat'];
        }

        $formFields['total_ex_vat'] = $totalExVat;
        $formFields['vat'] = $totalExVat * $vatRate;
        $formFields['total_inc_vat'] = $totalExVat * (1 + $vatRate);
        $formFields['sms_notifications'] = $request->has('sms_notifications') ? 1 : 0;
        $formFields['email_notifications'] = $request->has('email_notifications') ? 1 : 0;
        $order->update($formFields);

        if (!empty($formFields['vehicle_id'])) {
            $vehicle = Vehicle::find($formFields['vehicle_id']);
            if ($vehicle) {
                $vehicle->update(['mileage' => $formFields['vehicle_mileage']]);
            }
        }

        $order->items()->delete();
        foreach ($formFields['items'] as $itemData) {
            $order->items()->create($itemData);
        }

        if ($request->has('images')) {
            $order->images()->delete();
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('images', 'public');
                $order->images()->create(['path' => $imagePath]);
            }
        } else {
            $order->images()->createMany([]);
        }

        $removedImageIds = explode(',', $request->input('removedImageIds'));
        foreach ($removedImageIds as $imageId) {
            $image = OrderImage::find($imageId);
            if ($image) {
                $imagePath = $image->path;
                $image->delete();

                Storage::delete('public/' . $imagePath);
            }
        }

        $this->sendOrderStatusDoneEmail($order);
        $this->sendSmsNotification($order);


        return back()->with('message', 'Order updated successfully!');
    }

    public function destroy(Order $order)
    {

        if (auth()->id() !== $order->user_id && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $order->delete();
        return redirect('/orders')->with('message', 'Order deleted successfully!');
    }

    public function getTotalOrdersCount()
    {
        return Order::count();
    }

    public function getLast24HoursCount()
    {
        $date = Carbon::now()->subDay();
        return Order::where('created_at', '>=', $date)->count();
    }

    public function getLast7DaysCount()
    {
        $date = Carbon::now()->subDays(7);
        return Order::where('created_at', '>=', $date)->count();
    }

    public function getLast31DaysCount()
    {
        $date = Carbon::now()->subDays(31);
        return Order::where('created_at', '>=', $date)->count();
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function generatePDF(Order $order)
    {
        $order->load(['client', 'vehicle', 'items']);
        $invoice_number = substr($order->order_number, 1);
        $companyInformation = CompanyInformation::firstOrFail();
        $pdf = new Dompdf();

        $html = view('orders.pdf', compact('order', 'companyInformation', 'invoice_number'))->render();
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
        $pdf->loadHtml($html);

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isRemoteEnabled', true);

        $pdf->setOptions($options);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        return $pdf->stream('sąskaita faktūra, užsakymo-' . $order->order_number . '.pdf');
    }

    public function sendOrderStatusDoneEmail(Order $order)
    {
        $clientEmail = $order->client->email;
        $companyInformation = CompanyInformation::first();
        $client = $order->client;

        if ($order->email_notifications) {
            $emailSubject = '';
            $emailView = '';

            if ($order->status === 'Vykdomas') {
                $emailSubject = 'Jūsų užsakymas yra vykdomas';
                $emailView = 'emails.order_status_inprogress';
            } elseif ($order->status === 'Įvykdytas') {
                $emailSubject = 'Jūsų užsakymas yra įvykdytas';
                $emailView = 'emails.order_status_done';

                $invoice_number = substr($order->order_number, 1);
                $pdf = new Dompdf();
                $html = view('orders.pdf', compact('order', 'companyInformation', 'invoice_number'))->render();
                $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
                $pdf->loadHtml($html);
                $pdf->setPaper('A4', 'portrait');
                $pdf->render();
                $pdfContent = $pdf->output();

                $pdfFileName = 'sąskaita faktūra, užsakymo-' . $order->order_number . '.pdf';
                $emailAttachments = [
                    [
                        'data' => $pdfContent,
                        'filename' => $pdfFileName,
                    ],
                ];

                Mail::send($emailView, [
                    'order' => $order,
                    'client' => $client,
                    'companyInformation' => $companyInformation,
                ], function ($message) use ($clientEmail, $emailSubject, $emailAttachments) {
                    $message->to($clientEmail)
                        ->subject($emailSubject)
                        ->from(config('mail.from.address'), config('mail.from.name'))
                        ->attachData($emailAttachments[0]['data'], $emailAttachments[0]['filename']);
                });
                return;
            }
            elseif ($order->status === 'Atšauktas') {
                $emailSubject = 'Jūsų užsakymas yra atšauktas';
                $emailView = 'emails.order_status_cancelled';
            }

            if (!empty($emailView)) {
                Mail::send($emailView, [
                    'order' => $order,
                    'client' => $client,
                    'companyInformation' => $companyInformation,
                ], function ($message) use ($clientEmail, $emailSubject) {
                    $message->to($clientEmail)
                        ->subject($emailSubject)
                        ->from(config('mail.from.address'), config('mail.from.name'));
                });
            }
        }
    }

    public function sendSmsNotification(Order $order)
    {
        if ($order->sms_notifications) {
            $clientPhoneNumber = $order->client->phone;

            $twilioSid = 'AC9b437f47ffa49658c28bdb09304bbf6b';
            $twilioAuthToken = '88f0c56ff8d12ac848adbc3c447eb12b';
            $twilio = new TwilioClient($twilioSid, $twilioAuthToken);
            $twilioPhoneNumber = '+15414035168';
            $companyInformation = CompanyInformation::first();

            $smsText = "Sveiki, {$order->client->name},\n\nNorime jums pranešti, jog jūsų užsakymo {$order->order_number} būsena buvo atnaujinta į {$order->status}.\nDėl detalesnės informacijos galite kreiptis telefono numeriu: {$companyInformation->phone_number}.\n\nAčiū, jog renkatės mūsų paslaugas!\nJūsų, {$companyInformation->name}.\n{$companyInformation->address}";

            try {
                $twilio->messages->create(
                    $clientPhoneNumber,
                    [
                        'from' => $twilioPhoneNumber,
                        'body' => $smsText,
                    ]
                );

                return response()->json(['message' => 'SMS sėkmingai išsiųstas klientui.']);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Klaida siunčiant SMS klientui: ' . $e->getMessage()], 500);
            }
        }
    }
}

