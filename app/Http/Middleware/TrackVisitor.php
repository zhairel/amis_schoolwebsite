<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\VisitorLog;
use App\Models\DailyStat;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Execute the request first
        $response = $next($request);

        // Track only main web requests (exclude API, AJAX, and debugbar/assets)
        if ($request->isMethod('GET') && !$request->expectsJson() && !$request->ajax()) {
            try {
                $ip = $request->ip();
                $userAgent = $request->userAgent();
                $pageUrl = $request->getRequestUri();
                $referrer = $request->headers->get('referer');
                $today = now()->toDateString();

                // Save visitor log
                VisitorLog::create([
                    'ip_address' => $ip,
                    'user_agent' => $userAgent,
                    'page_url' => $pageUrl,
                    'referrer' => $referrer,
                    'visited_at' => now(),
                ]);

                // Check if this IP has visited today already
                $visitedToday = VisitorLog::where('ip_address', $ip)
                    ->whereDate('visited_at', $today)
                    ->count() > 1; // since we just created one, count > 1 means it visited already today

                $uniqueIncrement = $visitedToday ? 0 : 1;

                // Update or create daily stats record
                DailyStat::firstOrCreate(
                    ['date' => $today],
                    [
                        'total_visits' => 0,
                        'page_views' => 0,
                        'unique_visitors' => 0,
                    ]
                );

                DailyStat::where('date', $today)->update([
                    'total_visits' => DB::raw('total_visits + 1'),
                    'page_views' => DB::raw('page_views + 1'),
                    'unique_visitors' => DB::raw("unique_visitors + $uniqueIncrement"),
                ]);
            } catch (\Exception $e) {
                // Silently ignore DB errors on tracking to prevent page load failures
            }
        }

        return $response;
    }
}
