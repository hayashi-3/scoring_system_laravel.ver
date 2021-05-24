<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Histories;
use App\User;

class HistoryController extends Controller
{
    public function historiesList() {
        $user_id = Auth::id();
        $user = Auth::user();
        $histories = User::find($user_id)->Histories;
        return view('admin.histories.list', compact('histories', 'user'));
    }

}
