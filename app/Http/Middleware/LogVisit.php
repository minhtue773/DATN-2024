<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LogVisit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        if (!$this->isAssetRequest($request)) {
            // Lấy user_id nếu người dùng đã đăng nhập, nếu không thì để null
            $user_id = Auth::user()->id ?? null;
    
            // Lưu thông tin truy cập vào bảng visits
            Visit::create([
                'user_id' => $user_id,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'page' => $request->path(),
            ]);
        }    
        return $next($request);
    }
    private function isAssetRequest(Request $request)
    {
        // Kiểm tra nếu yêu cầu không phải là tài nguyên (ví dụ hình ảnh, JS, CSS)
        return $request->is('images/*') || $request->is('css/*') || $request->is('js/*') || $request->is('img/*') || $request->is('uploads/*');
    }
}
