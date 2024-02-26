<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HotelController extends Controller
{
    public function index() : Collection
    {
        /* $response = Http::get("https://jsonplaceholder.typicode.com/posts");
        dd($response->json()); */

        /* $response = Http::post("https://jsonplaceholder.typicode.com/posts", [
            'title' => "Mon post de Test sur json placeholder",
            'body' => "Mon super body",
            'userId' => 125,
        ]);
        dd($response->json()); */

        $unsplash = Http::get("https://api.unsplash.com/photos", [
            'client_id' => 'QVsQlyIhL5Jf_snHhwU1OoCyuVnAQCFCp38aMWkoJtE',
        ]);
        dd($unsplash->json());
    }
}
