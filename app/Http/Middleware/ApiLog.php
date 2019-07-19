<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Request;


/**
 * Api Log Middleware
 * Please customize it as per your needs for APIs
 * @author Himanshu Verma <himanshu.verma@appster.in>
 */
class ApiLog {

    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $headers = Request::header();

        return $this->logRequest($request, $headers, $next($request));
    }

    private function logRequest($request, $headers, $response) {
        foreach ($headers as &$h) {
            $h = $h[0];
        }
        $files = [];
        foreach ($request->file() as $k => $fl) {
            $files[$k] = $fl->getMimeType();
        }
        $log = [
            "Method" => $request->method(),
            "URL" => $request->url(),
            "Headers" => $headers,
            "Data" => $request->all(),
            "Files" => $files,
            "Response" => $this->logResponse($response)
        ];
        $log = json_encode($log, JSON_PRETTY_PRINT);
        file_put_contents(public_path() . "/api.log", $log);
        return $response;
    }

    private function logResponse($response) {
        $headers = $response->headers->all();
        foreach ($headers as &$h) {
            $h = $h[0];
        }
        if ($response->headers->get('content-type') == "application/json") {
            $log = [
                "Headers" => $headers,
                "Content" => json_decode($response->content())
            ];
        } else {
            $log = [
                "Headers" => $headers,
                "Content" => $response->content()
            ];
        }
        return $log;
    }

}
