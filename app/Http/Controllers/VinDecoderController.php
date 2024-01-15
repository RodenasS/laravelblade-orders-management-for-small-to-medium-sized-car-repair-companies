<?php

namespace App\Http\Controllers;

use App\Services\VinDecoderService;

class VinDecoderController extends Controller
{

    protected $vinDecoderService;

    public function __construct(VinDecoderService $vinDecoderService)
    {
        $this->middleware('auth');
        $this->vinDecoderService = $vinDecoderService;
    }

    public function show()
    {
        return view('vin_decoder');
    }

    public function decode($vin)
    {
        $data = $this->vinDecoderService->decodeVin($vin);
        return response()->json($data);
    }
}

