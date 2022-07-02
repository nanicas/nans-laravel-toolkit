<?php

namespace App\Helpers;

use Psr\Http\Message\ResponseInterface;
use Zevitagem\LegoAuth\Helpers\Helper as HelperVendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Helper
{
    public static function getAppId()
    {
        return config('app.app_id');
    }

    public static function extractJsonFromRequester(ResponseInterface $requester)
    {
        $content = $requester->getBody()->getContents();
        $json    = json_decode($content, true);

        return $json ?? self::createDefaultJsonToResponse(false,
                ['message' => $content]);
    }

    public static function createDefaultJsonToResponse(
        bool $status, $content = null
    )
    {
        return ['response' => $content, 'status' => $status];
    }

    public static function getToken()
    {
        return HelperVendor::getToken();
    }

    public static function getSlug()
    {
        return HelperVendor::getSlug();
    }

    public static function getCustomer()
    {
        return HelperVendor::getCustomer();
    }

    public static function getContract()
    {
        return HelperVendor::getContract();
    }

    public static function getUserConfig()
    {
        return HelperVendor::getUserConfig();
    }

    public static function getSessionData()
    {
        return HelperVendor::getSessionData();
    }

    public static function getUserId()
    {
        return Auth::id();
    }

    public static function isMaster()
    {
        return HelperVendor::isMaster();
    }

    public static function isAdmin()
    {
        return HelperVendor::isAdmin();
    }

    public static function notAllowedResponse(Request $request)
    {
        $view = view('layouts.error.not_allowed')->render();

        if (!$request->ajax()) {
            return response($view);
        }

        return response()->json([
            'status' => 'false',
            'content' => $view,
        ], 405);
    }
}