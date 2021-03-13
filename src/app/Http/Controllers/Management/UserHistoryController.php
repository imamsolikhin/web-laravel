<?php

namespace App\Http\Controllers\Management;

use DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserLoginHistory;

class UserHistoryController extends Controller {
    public function showLoginHistory()
    {
      if(!getAuthMenu('management.login-history',VIEW)){
        return redirect()->route('noauth');
      }

        $page_title = 'User Login History';
        $page_description = 'Home/User Management/User Login History';

        return view('management.user.login-history', compact('page_title', 'page_description'));
    }

    public function getLoginHistoryData()
    {

        $userLoginHistory = UserLoginHistory::with('user')->select('user_login_histories.*');

        return Datatables::of($userLoginHistory)
            ->editColumn('created_at', function($userLoginHistory) {
                return $userLoginHistory->created_at->format('d M Y H:i:s');
            })
            ->make(true);
    }
}
