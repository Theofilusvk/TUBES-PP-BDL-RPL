<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        try {
            DB::table('tr_pengirimannotifikasi')
                ->where('KirimID', $id)
                ->where('PenggunaTargetID', Auth::id())
                ->update(['IsRead' => true]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    
    public function markAllAsRead()
    {
         try {
            DB::table('tr_pengirimannotifikasi')
                ->where('PenggunaTargetID', Auth::id())
                ->update(['IsRead' => true]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
