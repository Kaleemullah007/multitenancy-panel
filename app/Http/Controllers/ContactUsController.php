<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactUsController extends Controller
{
    // Store Captache
    public function store(StoreContactRequest $request)
    {
        $data = $request->except(['captache', '_token']);

        if ($request->has('photo')) {
            $path = Storage::disk('public')->putFile('contacts', $request->file('photo'));
            $data['file'] = $path;
        }

        Contact::Create($data);

        return redirect()->back()->with('message', 'Administrator will contact with you soon')->withFragment('contact');
    }


    // Captache Loader

    public  function loadCapatche()
    {
        header("Content-type: image/png");
        $str = '';
        $string = "abcdefghijklmnopqrstuvwxyz0123456789";
        for ($i = 0; $i < 5; $i++) {
            $pos = rand(0, 35);
            $str .= $string[$pos];
        }
        // echo $str;
        // die();
        $img_handle = ImageCreate(60, 22) or die("Es imposible crear la imagen");
        $back_color = ImageColorAllocate($img_handle, 000, 000, 153);
        $txt_color = ImageColorAllocate($img_handle, 255, 255, 255);
        ImageString($img_handle, 31, 5, 0, $str, $txt_color);
        Imagepng($img_handle);
        session(['captache' => $str]);
    }
}
