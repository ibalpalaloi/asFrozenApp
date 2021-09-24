<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class AdminVideoController extends Controller
{
    //
    public function video(){
        $list_video = array();
        $video = Video::all();
        $i=0;
        foreach($video as $data){
            $list_video[$i]['id'] = $data->id;
            $list_video[$i]['link'] = $data->link;
            $list_video[$i]['link_embed'] = $this->get_embed_video($data->link);
            $i++;
        }
        $menu = "data dukung";
        $sub_menu = 'video';
        return view('admin.video', compact('list_video', 'menu', 'sub_menu'));
    }

    public function get_embed_video($link){
        $ytarray=explode("/", $link);
        $ytendstring=end($ytarray);
        $ytendarray=explode("?v=", $ytendstring);
        $ytendstring=end($ytendarray);
        $ytendarray=explode("&", $ytendstring);
        $ytcode=$ytendarray[0];

        return $ytcode;
    }

    public function post_video(Request $request){
        $video = Video::find($request->id);
        $video->link = $request->link;
        $video->save();

        $link_embed = $this->get_embed_video($request->link);

        return response()->json(['embed_link'=>$link_embed]);
    }
}
