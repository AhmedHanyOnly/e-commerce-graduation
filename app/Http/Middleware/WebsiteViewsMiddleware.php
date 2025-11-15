<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\WebsiteView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class WebsiteViewsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            $websiteView  = WebsiteView::where('ip', $request->ip())->first();
            if (!$websiteView) {
                $response = Http::get('https://ipinfo.io/' . request()->ip() . '?token=359519c2dbae6e');
                if ($response->successful()) {
                    $data = $response->json();
                    if (isset($data['country'])) {
                        WebsiteView::updateOrCreate(['ip' => request()->ip()], [
                            'address' => $data['country'] . ',' . $data['region'] . ',' . $data['city'],
                            'lat' => explode(',', $data['loc'])[0],
                            'long' => explode(',', $data['loc'])[1]
                        ]);
                    }
                }
            }
        }
        return $next($request);
    }
}
