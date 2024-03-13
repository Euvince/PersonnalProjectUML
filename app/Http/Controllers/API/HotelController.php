<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use function Ramsey\Uuid\v1;

class HotelController extends Controller
{
    public function index()
    {
        /* $response = Http::get("https://jsonplaceholder.typicode.com/posts");
        dd($response->json()); */

        /* $response = Http::post("https://jsonplaceholder.typicode.com/posts", [
            'title' => "Mon post de Test sur json placeholder",
            'body' => "Mon super body",
            'userId' => 125,
        ]);
        dd($response->json()); */

        $pictures = Http::get("https://api.unsplash.com/photos/random?query=Waldorf Astoria&client_id=um4ox2vMwBA5lMimLj2-TxNrD73blAkEkGv5nwo2nxs"/* , [
            'client_id' => 'QVsQlyIhL5Jf_snHhwU1OoCyuVnAQCFCp38aMWkoJtE',
            'count' => '15',
        ] */)->json()/* ['urls']['regular'] */;
        /* dd($pictures); */
        return view('essais', compact('pictures'));
    }
}
