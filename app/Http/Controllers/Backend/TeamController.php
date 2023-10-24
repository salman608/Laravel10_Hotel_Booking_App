<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BookArea;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class TeamController extends Controller
{
    public function AllTeam()
    {
        $team = Team::latest()->get();
        return view('backend.team.all_team', compact('team'));
    }

    public function AddTeam()
    {
        return view('backend.team.add_team');
    }

    public function StoreTeam(Request $request)
    {
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(550, 670)->save('upload/team/' . $name_gen);
        $save_url = 'upload/team/' . $name_gen;

        Team::insert([
            'name' => $request->name,
            'position' => $request->position,
            'facebook' => $request->facebook,
            'image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => "Team Stored Successfully",
            'alert-type' => 'success',
        );
        return redirect()->route('all.team')->with($notification);
    }

    public function EditTeam($id)
    {
        $item = Team::findOrFail($id);
        return view('backend.team.edit_team', compact('item'));
    }

    public function UpdateTeam(Request $request)
    {
        $team_id = $request->id;
        if ($request->file('image')) {
            $image = $request->file('image');
            // @unlink(public_path('upload/team/' . $team_id->photo));
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(550, 670)->save('upload/team/' . $name_gen);
            $save_url = 'upload/team/' . $name_gen;

            Team::findOrFail($team_id)->update([
                'name' => $request->name,
                'position' => $request->position,
                'facebook' => $request->facebook,
                'image' => $save_url,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => "Team Updated with Image Successfully",
                'alert-type' => 'success',
            );
            return redirect()->route('all.team')->with($notification);
        } else {
            Team::findOrFail($team_id)->update([
                'name' => $request->name,
                'position' => $request->position,
                'facebook' => $request->facebook,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => "Team Updated without Image Successfully",
                'alert-type' => 'success',
            );
            return redirect()->route('all.team')->with($notification);
        }
    }

    public function DeleteTeam($id)
    {
        $item = Team::findOrFail($id);
        $img = $item->image;
        unlink($img);
        Team::findOrFail($id)->delete();

        $notification = array(
            'message' => "Team Delete Successfully",
            'alert-type' => 'success',
        );
        return back()->with($notification);
    }

    // ========Book Area Controller===========

    public function ViewBookarea()
    {
        $bookarea = BookArea::find(1);
        return view('backend.bookarea.book_area', compact('bookarea'));
    }

    public function UpdateBookarea(Request $request)
    {
        $bookarea_id = $request->id;
        if ($request->file('image')) {
            $image = $request->file('image');
            @unlink(public_path('upload/bookarea/' . $bookarea_id->photo));
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(1000, 1000)->save('upload/bookarea/' . $name_gen);
            $save_url = 'upload/bookarea/' . $name_gen;

            BookArea::findOrFail($bookarea_id)->update([
                'short_title' => $request->short_title,
                'main_title' => $request->main_title,
                'short_desc' => $request->short_desc,
                'link_url' => $request->link_url,
                'image' => $save_url,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => "Book Area Updated with Image Successfully",
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        } else {
            BookArea::findOrFail($bookarea_id)->update([
                'short_title' => $request->short_title,
                'main_title' => $request->main_title,
                'short_desc' => $request->short_desc,
                'link_url' => $request->link_url,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => "Book Area Updated without Image Successfully",
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }
    }
}
