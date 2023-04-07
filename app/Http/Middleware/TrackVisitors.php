<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Retrieve visitor's IP address
        $ip = $request->ip();

        // Check if visitor's IP address is already in database
        $visitor = Visitor::where('ip_address', $ip)->first();

        if($visitor) {
            // Update timestamp
            $visitor->timestamps = false;
            $visitor->touch();
        } else {
            // Insert new record
            $page = $request->path();
            Visitor::create([
                'ip_address' => $ip,
                'page' => $page
            ]);
        }
        return $next($request);
    }
}
