@extends('components/layout')

@section('content')
    <div class="mt-8 px-6 container mx-auto">
        <h2 class="text-2xl font-semibold mb-4">Order PDFs for Order #{{ $order->order_number }}</h2>
        @if ($orderPdfs)
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        File Name
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($orderPdfs as $pdf)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $pdf->file_name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('order.pdf.download', ['order' => $order->id, 'pdf' => $pdf->id]) }}" class="text-blue-600 hover:text-blue-900">Download</a>
                            <a href="{{ route('order.pdf.preview', ['order' => $order->id, 'pdf' => $pdf->id]) }}" class="ml-2 text-green-600 hover:text-green-900">Preview</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>No order PDFs available for this order.</p>
        @endif
    </div>
@endsection
