<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\FlashMessages;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;

class BaseController extends Controller
{
    use FlashMessages;

    protected $data = null;

    /**
     * @param $title
     * @param $subTitle
     */
    protected function setPageTitle($title, $subTitle = '')
    {
        view()->share(['pageTitle' => $title, 'subTitle' => $subTitle]);
    }

    /**
     * @param int $errorCode
     * @param null $message
     * @return \Illuminate\Http\Response
     */
    protected function showErrorPage($errorCode = 404, $message = null)
    {
        $data['message'] = $message;
        return response()->view('errors.' . $errorCode, $data, $errorCode);
    }

    /**
     * @param bool $error
     * @param int $responseCode
     * @param array $message
     * @param null $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseJson($status = true, $responseCode = 200, $message = "", $data = null)
    {
        return response()->json([
            'status'        =>  $status,
            'response_code' =>  $responseCode,
            'message'       =>  $message,
            'data'          =>  $data ?? []
        ]);
    }

    /**
     * @param $route
     * @param $message
     * @param string $type
     * @param bool $error
     * @param bool $withOldInputWhenError
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function responseRedirect($route, $message, $type = 'info', $error = false, $withOldInputWhenError = false)
    {
        // if ($type != 'noFlash') {
        //     $this->setFlashMessage($message, $type);
        //     $this->showFlashMessages();
        // }

        if ($error && $withOldInputWhenError) {
            return redirect()->back()->withInput();
        }

        if (!empty($urlparams)) {
            return redirect()->route($route, $urlparams);
        } else {
            return redirect()->route($route);
        }
    }

    /**
     * @param $route
     * @param $queryParams
     * @param $message
     * @param string $type
     * @param bool $error
     * @param bool $withOldInputWhenError
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function responseRedirectWithQueryString($route, $queryParams, $message, $type = 'info', $error = false, $withOldInputWhenError = false)
    {
        $this->setFlashMessage($message, $type);
        $this->showFlashMessages();

        if ($error && $withOldInputWhenError) {
            return redirect()->back()->withInput();
        }

        return redirect()->route($route, $queryParams);
    }

    /**
     * @param $message
     * @param string $type
     * @param bool $error
     * @param bool $withOldInputWhenError
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function responseRedirectBack($message, $type = 'info', $error = false, $withOldInputWhenError = false, $anchor = "")
    {
        $this->setFlashMessage($message, $type);
        $this->showFlashMessages();
        $anchor = !empty($anchor) ? $anchor : '';
        return Redirect::to(URL::previous() . $anchor);
    }

    /**
     * setMetaDetails
     *
     * @param  mixed $meta
     * @return void
     */
    protected function setMetaDetails($meta)
    {
        view()->share(['meta' => $meta]);
    }
}
