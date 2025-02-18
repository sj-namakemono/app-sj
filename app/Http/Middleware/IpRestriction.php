<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IpRestriction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allowedIpsString = config('ip-restriction.allowed_ips');

        // IPリストが空の場合は制限をスキップ
        if (empty($allowedIpsString)) {
            return $next($request);
        }

        // リバースプロキシを考慮したIPアドレス取得
        $clientIp = $this->getClientIp($request);

        // カンマ区切りのIPリストを配列に変換
        $allowedIps = array_map('trim', explode(',', $allowedIpsString));

        if (!in_array($clientIp, $allowedIps)) {
            abort(403, 'Access denied');
        }

        return $next($request);
    }

    private function getClientIp(Request $request): string
    {
        // X-Forwarded-For ヘッダーをチェック
        $xForwardedFor = $request->header('X-Forwarded-For');
        if ($xForwardedFor) {
            // カンマで区切られた場合、最初のIPを取得（クライアントIP）
            $ips = explode(',', $xForwardedFor);
            return trim($ips[0]);
        }

        // X-Real-IP ヘッダーをチェック
        $xRealIp = $request->header('X-Real-IP');
        if ($xRealIp) {
            return trim($xRealIp);
        }

        // 上記ヘッダーがない場合は通常のIPアドレスを取得
        return $request->ip();
    }
}
