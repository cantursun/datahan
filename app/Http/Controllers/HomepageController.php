<?php

namespace App\Http\Controllers;

use App\Http\Requests\Site\Message\ContactFormRequest;
use App\Models\About;
use App\Models\Message;
use App\Models\Portfolio;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abouts = About::query()
            ->where('is_published', true)
            ->get();

        $portfolios = Portfolio::query()
            ->where('is_published', true)
            ->get();

        $mapAddressUrl=Setting::query()
            ->where('key','mapAddressUrl')
            ->first();

        $address=Setting::query()
            ->where('key','address')
            ->first();

        $phone=Setting::query()
            ->where('key','phone')
            ->first();

        return view('site.pages.homepage.index', compact('abouts', 'portfolios', 'mapAddressUrl', 'address', 'phone'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function contactForm(ContactFormRequest $request)
    {
        $data=  [
            'status' => false,
            'message' => 'Mesaj gönderilirken bir hata meydana geldi!'
        ];

        try {
            $message = Message::query()
                ->create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'message' => $request->message,
                ]);

            if (!$message)
                return response()->json($data);

            $data['status'] = true;
            $data['message'] = 'Mesajınız başarıyla alınmıştır.';

        }catch (\Exception $exception){
            $data['message'] = 'Mesaj gönderilirken bir hata meydana geldi! :' . $exception->getMessage();
        }

        return response()->json($data);
    }
}
