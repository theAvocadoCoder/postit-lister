<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Postit;
use Illuminate\Support\Facades\DB;

class PostitController extends Controller
{
    public function index() {
        $postits = DB::table('postits')->get();
        return view('postit.index', ['postits' => $postits]);
    }

    public function addPostit(Request $req) {
        $userId = $req->session()->get('userid');
        $data = $req->input();
        $postit = DB::table('postits')
            ->where('id', $req->input('postitId'))
            ->get();
        if (isset($postit[0]->body) && $req->session()->get('edit_body') == $postit[0]->body) {
            DB::update('update postits set title = ?, body = ? where userid = ? and id = ?', [$data['title'], $data['body'], $userId, $data['postitId']]);
        } else {
            $newPostit = new Postit;
            $newPostit->title = $data['title'];
            $newPostit->body = $data['body'];
            $newPostit->userid = $userId;
            $newPostit->save();
            $req->session()->flash('status', 'Post-it Added Successfully!');
        }
        return redirect('/');
    }

    public function viewPostits() {
        $userId = session()->get('userid');
        $postits = DB::table('postits')
            ->where('userid', $userId)
            ->get();
        return view('postits', ['postits' => $postits]);
    }

    public function editPostit(Request $req) {
        $userId = $req->session()->get('userid');
        $postits = DB::table('postits')
            ->where('userid', $userId)
            ->get();
        $postit = DB::table('postits')
            ->where('id', $req->input('postitId'))
            ->get();
        $req->session()->flash('edit_title', $postit[0]->title);
        $req->session()->flash('edit_body', $postit[0]->body);
        return view('index', ['postit' => $postit[0]]);
    }

    public function deletePostit(Request $req) {
        DB::delete('delete from postits where id = ?', [$req->input('postitId')]);
        return redirect('/viewPostits');
    }
}
