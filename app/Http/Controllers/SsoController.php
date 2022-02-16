<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\User;
use Spatie\Permission\Models\Role;
use Auth, DB;
use Hash;


class SsoController extends Controller
{
    public function __construct()
    {
        $this->url = "https://idam.metrosystems.net/authorize/api/oauth2/";
        $this->redirect = urlencode(url('sso-redirect'));
        $this->scope = "openid";
        $this->response_type = "id_token";
        $this->client_id = "LOCK_IN_TOOL";
        // $this->client_secret = "qu1TyDtvhw";
        $this->client_secret = "wV8aFsWlr8";
        $this->realm_id = "CUST_PROFIT";
        $this->state = md5(uniqid(rand(), true));
        $this->code_verifier = "AdleUo9ZVcn0J7HkXOdzeqN6pWrW36K3JgVRwMW8BBQazEPV3kFnHyWIZi2jt9gP";
        $this->code_challenge = hash("sha256", $this->code_verifier);
    }

    public function signInUrl()
    {
        //return $loginUrl = "https://idam.metrosystems.net/web/Signin?nonce=nonce&scope=openid%20profile%20email&locale_id=en-GB&redirect_uri=" . $this->redirect . "&client_id=" . $this->client_id . "&country_code=IN&realm_id=" . $this->realm_id . "&user_type=EMP&DR-Trace-ID=idam-trace-id&response_type=code&state=" . $this->state;
        return $loginUrl = "https://idam.metrosystems.net/web/Signin?redirect_uri=" . $this->redirect . "&client_id=" . $this->client_id . "&realm_id=" . $this->realm_id . "&user_type=EMP&DR-Trace-ID=idam-trace-id&response_type=code&state=" . $this->state;
    }

    public function index(Request $request)
    {

        $all = Session::get('authLogin');

        if (!empty($all->access_token)) {

            $check = $this->checkAccessToken($all);

            if (!empty($check)) {
                return redirect('sso-action');
            } else {
                $getNewToken = $this->getNewAccessToken($all);

                if (!empty($getNewToken)) {
                    return redirect('sso-action');
                }
            }
        }

        $loginUrl = $this->signInUrl();
        return redirect($loginUrl);
    }

    public function checkAccessToken($requestData = array())
    {

        if (!empty($requestData)) {

            $para['method'] = "post";
            $para['url'] = $this->url . "/introspect";

            $para['data'] = array(

                'client_id' => $this->client_id,
                'client_secret' => $this->client_secret,
                //'token_type_hint'=>$requestData->id_token,
                'token' => $requestData->access_token,
            );

            $para['header'] = array(
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Basic ' . base64_encode($this->client_id . ':' . $this->client_secret)
            );
            $result = $this->curlAction($para);


            if (!empty($result['status']) && $result['data']->active == "true") {

                return true;
            } else {
                return false;
            }
        }
    }

    public function getNewAccessToken($requestData = array())
    {

        if (!empty($requestData)) {

            $para['method'] = "post";
            $para['url'] = $this->url . "/access_token";

            $para['data'] = array(
                'grant_type' => 'refresh_token',
                'client_id' => $this->client_id,
                'client_secret' => $this->client_secret,
                'realm_id' => $this->realm_id,
                'refresh_token' => $requestData->refresh_token,
            );

            $para['header'] = array(
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Basic ' . base64_encode($this->client_id . ':' . $this->client_secret)
            );
            $result = $this->curlAction($para);


            if (!empty($result['status']) && !empty($result['data']->access_token)) {
                Session::put('authLogin', $result['data']);
                return true;
            } else {
                return false;
            }
        }
    }

    public function redirect(Request $request)
    {

        if (!empty($request->get('code'))) {

            $para['method'] = "post";
            $para['url'] = $this->url . "/access_token";

            $para['data'] = array(
                'grant_type' => 'authorization_code',
                'code' => $request->get('code'),
                'redirect_uri' => urldecode($this->redirect),
            );

            $para['header'] = array(
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Basic ' . base64_encode($this->client_id . ':' . $this->client_secret)
            );
            $result = $this->curlAction($para);

            if (!empty($result['status'])) {
                Session::put('authLogin', $result['data']);
                return redirect('sso-action');
            } else {
                echo $result['message'];
            }
        }
    }

    public function action(Request $request)
    {

        $all = Session::get('authLogin');
        if (!empty($all->access_token)) {
            $accessToken = $all->access_token;
            // $result = $this->getUserInfo($accessToken);
            $result = $this->getUserAllInfo($accessToken);

            if ($result['data'] == null) {
                return redirect('message')->with('error', 'Idam Server Error');
            }
            // $result2 = $this->manager($accessToken, $result1['data']->managermetroid);
            if (!empty($result['status'])) {

                $email = $result['data']->mail;
                $authUser = User::where('email', $email)->first();
                if (!$authUser) {
                    $authUser = User::create([
                        'name'     => $result['data']->displayname,
                        'email'    => $result['data']->mail,
                        'empId'    => $result['data']->employeenumber,
                        'password' => Hash::make('metroservices1$#$'),
                    ]);

                    //  $authUser->syncRoles($role);
                }
                /*else {
                    $authUser->name = $result['data']->displayname;
                    $authUser->manager_metroid = $result['data']->managermetroid;
                    $authUser->center = $result['data']->metrocostcenter;
                    $authUser->save();

                    if (isset($authUser->roles[0]) && $authUser->roles[0]->id == 7) {
                        $authUser->syncRoles($role);
                    }
                } */
                if (!empty($authUser)) {
                    if ($authUser->status == 1) {
                        Auth::login($authUser, true);
                        return redirect('customer');
                    } else {
                        return redirect('landing')->with('error', 'Sorry, Your account is not active yet.');
                    }
                } else {
                    return redirect('message')->with('error', 'Sorry, Your record not found in our system');
                }
            } else {
                return redirect('message')->with('error', $result['message']);
            }
        } else {
            $loginUrl = $this->signInUrl();
            return redirect($loginUrl);
        }
    }

    public function action_new(Request $request)
    {
        $all = Session::get('authLogin');

        if (!empty($all->access_token)) {

            $accessToken = $all->access_token;
            $result = $this->getUserInfo($accessToken);
            // dd($result);

            if (!empty($result['status'])) {

                $email = $result['data']->email;

                $authUser = User::where('email', $email)->first();
                //  dd($authUser);

                if (!empty($authUser)) {

                    if ($result['status'] == 1) {
                        Auth::login($authUser, true);
                        Session::put('email', $email);
                        return redirect('customer');
                    } else {
                        return redirect('message')->with('error', __('Sorry, Your account is not active yet!'));
                    }
                } else {
                    return redirect('message')->with('error', __('Sorry, Your record is not found in our system!'));
                }
            } else {

                return redirect('message')->with('error', $result['message']);
            }
        } else {
            $loginUrl = $this->signInUrl();
            return redirect($loginUrl);
        }
    }
    public function getUserInfo($accessToken)
    {

        $para['method'] = "post";
        $para['url'] = $this->url . "/userInfo";

        $para['header'] = array(
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: Bearer ' . $accessToken
        );
        return $this->curlAction($para);
    }

    public function getUserAllInfo($accessToken)
    {

        $para['method'] = "get";

        $para['url'] = "https://app.iam.metro.cloud/pgidentitydetails/v1/identityDetails/me";

        $para['header'] = array(

            'Content-Type: application/x-www-form-urlencoded',

            'Authorization: Bearer ' . $accessToken
        );

        return $this->curlAction($para);
    }

    public function curlAction($params = array())
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $params['url']);

        if ($params['method'] == 'post') {
            curl_setopt($ch, CURLOPT_POST, 1);

            if (!empty($params['data'])) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params['data']));
            }
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if (!empty($params['header'])) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $params['header']);
        }
        $response = json_decode(curl_exec($ch));

        if (curl_error($ch)) {

            $result = array(
                'status' => 0,
                'message' => curl_error($ch),
                'data' => ''
            );
        } else {
            if (!empty($response->error)) {
                $result = array(
                    'status' => 0,
                    'message' => $response->error_description,
                    'data' => $response
                );
            } else {

                $result = array(
                    'status' => 1,
                    'message' => 'success',
                    'data' => $response
                );
            }
        }
        curl_close($ch);
        return $result;
    }

    public function message(Request $request)
    {
        return view('include.message');
    }
}
