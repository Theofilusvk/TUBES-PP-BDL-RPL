<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationComposer
{
    public function compose(View $view)
    {
        if (Auth::check()) {
            $user = Auth::user();
            \Illuminate\Support\Facades\Log::info('NotificationComposer running for user: ' . $user->PenggunaID);
            
            // Calculate unread count globally for the user
            $unreadCount = DB::table('tr_pengirimannotifikasi')
                ->where('PenggunaTargetID', $user->PenggunaID)
                ->where('IsRead', false)
                ->count();

            // Join ms_notifikasi and tr_pengirimannotifikasi
            $notifications = DB::table('tr_pengirimannotifikasi')
                ->join('ms_notifikasi', 'tr_pengirimannotifikasi.NotifikasiID', '=', 'ms_notifikasi.NotifikasiID')
                ->where('tr_pengirimannotifikasi.PenggunaTargetID', $user->PenggunaID)
                ->select(
                    'ms_notifikasi.JudulNotifikasi',
                    'ms_notifikasi.IsiNotifikasi',
                    'tr_pengirimannotifikasi.WaktuKirim',
                    'tr_pengirimannotifikasi.KirimID as id',
                    'ms_notifikasi.TipeNotifikasi',
                    'ms_notifikasi.EventID',
                    'tr_pengirimannotifikasi.IsRead'
                )
                ->orderBy('tr_pengirimannotifikasi.WaktuKirim', 'desc')
                ->limit(5)
                ->get();
            
            \Illuminate\Support\Facades\Log::info('Notification Count: ' . $notifications->count());
            
            // Map to the format expected by the frontend
            $formattedNotifications = $notifications->map(function ($note) {
                // Link is nice to have, but we will focus on Mark Read button as requested
                $link = '#';
                if ($note->EventID) {
                    $link = route('dashboard.events', ['event_id' => $note->EventID]);
                }

                return [
                    'id' => $note->id,
                    'title' => $note->JudulNotifikasi,
                    'time' => \Carbon\Carbon::parse($note->WaktuKirim)->diffForHumans(),
                    'desc' => $note->IsiNotifikasi,
                    'icon' => $this->getIcon($note->TipeNotifikasi),
                    'color' => $this->getColor($note->TipeNotifikasi),
                    'bg' => $this->getBg($note->TipeNotifikasi),
                    'link' => $link,
                    'is_read' => (bool)$note->IsRead
                ];
            });

            $view->with('notifications', $formattedNotifications->values());
            $view->with('hasUnread', $unreadCount > 0);
            $view->with('unreadCount', $unreadCount);
        } else {
            $view->with('notifications', collect([]));
            $view->with('hasUnread', false);
            $view->with('unreadCount', 0);
        }
    }

    private function getIcon($type)
    {
        return match ($type) {
            'Info' => 'info',
            'Warning' => 'warning',
            'Success' => 'check_circle',
            'Event' => 'event', 
            default => 'notifications',
        };
    }

    private function getColor($type)
    {
        return match ($type) {
            'Info' => 'text-blue-500',
            'Warning' => 'text-yellow-500',
            'Success' => 'text-green-500',
            'Event' => 'text-purple-500', 
            default => 'text-gray-500',
        };
    }
    
    private function getBg($type)
    {
        return match ($type) {
            'Info' => 'bg-blue-100 dark:bg-blue-900/30',
            'Warning' => 'bg-yellow-100 dark:bg-yellow-900/30',
            'Success' => 'bg-green-100 dark:bg-green-900/30',
             'Event' => 'bg-purple-100 dark:bg-purple-900/30',
            default => 'bg-gray-100 dark:bg-gray-800',
        };
    }
}
