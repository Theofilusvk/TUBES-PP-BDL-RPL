<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Existing Admin Composer (Closure-based)
        \Illuminate\Support\Facades\View::composer(['admin.*', 'layouts.admin'], function ($view) {
            $notifications = collect();
            if (\Illuminate\Support\Facades\Auth::check()) {
                $notifications = \Illuminate\Support\Facades\DB::table('tr_pengirimannotifikasi')
                    ->join('ms_notifikasi', 'tr_pengirimannotifikasi.NotifikasiID', '=', 'ms_notifikasi.NotifikasiID')
                    ->leftJoin('ms_event', 'ms_notifikasi.EventID', '=', 'ms_event.EventID')
                    ->where('tr_pengirimannotifikasi.PenggunaTargetID', \Illuminate\Support\Facades\Auth::id())
                    ->select(
                        'ms_notifikasi.*',
                        'tr_pengirimannotifikasi.WaktuKirim',
                        'tr_pengirimannotifikasi.StatusKirim',
                        'tr_pengirimannotifikasi.KirimID',
                        'tr_pengirimannotifikasi.IsRead',
                        'ms_event.NamaEvent'
                    )
                    ->orderBy('tr_pengirimannotifikasi.WaktuKirim', 'desc')
                    ->limit(5)
                    ->get();
                
                $unreadCount = \Illuminate\Support\Facades\DB::table('tr_pengirimannotifikasi')
                    ->where('PenggunaTargetID', \Illuminate\Support\Facades\Auth::id())
                    ->where('IsRead', false)
                    ->count();
            }
            $view->with('unreadNotifications', $notifications);
            $view->with('adminUnreadCount', $unreadCount ?? 0);
        });

        // Participant Dashboard Composer
        \Illuminate\Support\Facades\View::composer(
            ['layouts.dashboard', 'dashboard.*'], 
            \App\Http\View\Composers\NotificationComposer::class
        );
    }
}
