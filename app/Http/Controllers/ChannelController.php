<?php

namespace App\Http\Controllers;

use App\Channel;
use Illuminate\Http\Request;
use Image;
use File;
use App\Http\Requests\Channels\UpdateChannelRequest;

class ChannelController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth'])->only('update');
    }
    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Channel $channel)
    {
        if (view()->exists('channels.show'))
        {
            return view('channels.show', compact('channel'));
        }
        abort(404);
    }


    public function edit(Channel $channel)
    {
        //
    }


    public function update(UpdateChannelRequest $request, Channel $channel)
    {
        // echo '<pre>';
        // print_r($channel->toArray());
        // exit;
        if ($request->hasFile('image')) {
            $ext = $request->image->getClientOriginalExtension();
            $name = time().".".$ext;
            $upload_path = 'backend/channel/';
            $img = Image::make($request->image)->resize(100,100);
            $image_url = $upload_path.$name;
            $img->save($image_url);
            if(File::exists($channel->image))
            {
                unlink($channel->image);
            }
            $channel->update([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $image_url,
            ]);
        }
        else{
            $channel->update([
                'name' => $request->name,
                'description' => $request->description
            ]);
        }
        return redirect()->back();
    }


    public function destroy(Channel $channel)
    {
        //
    }
}
