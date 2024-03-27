<?php


namespace App\Http\Controllers;
use App\Models\Link;
use Illuminate\Http\Request;
use App\Http\Requests\LinkRequest;
use Illuminate\Support\Facades\Session;

class LinkController extends Controller
{
    public function index()
    {
        return redirect()->route('link.list');
    }    
    public function listUrls()
{
    $urls = Link::all();
    return view('welcome', ['urls' => $urls]);
}
public function shorten(LinkRequest $request)
{
   
    
    $originalUrl = $request->input('url');
    $urlExist = $this->check_if_url_exist($originalUrl);

    if (!$urlExist->isEmpty()) {
        Session::flash('error', 'URL already exists.');
    } else {
        $shortCode = $this->generateShortenedUrl(); 

        $url = Link::create([
            'original_url' => $originalUrl,
            'short_code' => $shortCode,
        ]);
        
        Session::flash('success', 'URL added successfully. Short URL: ' . $url->short_code);
    }

    return redirect()->back();
}
    public function redirect($shortCode)
    {
        $link = Link::where('short_code', $shortCode)->first();

        if ($link) {
            $link->increment('hits');
            return redirect($link->original_url);
        }

        abort(404); 
    }
    public function generateShortenedUrl()
    {
        $length = rand(3, 5);

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        do {
            $token = '';
            for ($i = 0; $i < $length; $i++) {
                $token .= $characters[rand(0, strlen($characters) - 1)];
            }
        } while ($this->tokenExists($token));

        return $token;
    }

    public function tokenExists($token)
    {
        return Link::where('original_url', $token)->exists();
    }
    public function check_if_url_exist($original_url)
    {
        return Link::where('original_url', $original_url)->get();
    }
}
