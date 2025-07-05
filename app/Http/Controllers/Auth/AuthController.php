<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Mail\AdminNewUserMail;
use App\Mail\PasswordResetMail;
use App\Mail\VerifyUserMail;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * User register page show
     *
     * @method GET
     * @return Illuminate\Http\Request Response
     */
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('login');
        }
        $this->setPageTitle('Register');
        $data['breadcrumb'] = ['Home' => route('index'), 'Register' => ''];
        return view('auth.register',$data);
    }

    /**
     * User register page show
     *
     * @method POST
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Request Response
     */
    public function store(RegisterRequest $request)
    {

        $role = Role::where('slug', 'client_portal')->first();
        $admin = User::where('role_id', 1)->first();
        $verify_code = Str::random(64);
        $user = User::create([
            'role_id'            => $role->id,
            'fname'              => $request->fname,
            'lname'              => $request->lname,
            'email'              => $request->email,
            'phone'              => $request->phone,
            'password'           => Hash::make($request->password),
            'email_verified_at'  => now(),
            'status'             => '2',
            'verify_code'        =>  $verify_code,
        ]);

        $request['roleName']             = $role->name;
        $request['full_name']            = $request->fname . ' ' . $request->lname;
        $request['email']                = $request->email;
        $request['admin_name']           = $admin->fname . ' ' . $admin->lname;
        $request['account_created_date'] = Carbon::now()->format('j M Y h:i A');
        $request['button_url']           = URL::temporarySignedRoute('verify.code', now()->addHours(1), ['token' => $verify_code]);
        $request['button_title']         = 'Click Here To Verify Email';
        $request['app_name']             = env('APP_NAME') ?? 'Laravel';

        // User mail
        $subject = emailSubjectTemplate('NEW_USER_MAIL', $request);
        $body    = emailBodyTemplate('NEW_USER_MAIL', $request);
        $heading = emailHeadingTemplate('NEW_USER_MAIL', $request);
        $userMail = ['subject' => $subject, 'body' => $body, 'heading' => $heading];
        Mail::to($request->email)->send(new VerifyUserMail($userMail));

        // Admin mail
        // $subject = emailSubjectTemplate('NEW_USER_ADMIN_MAIL', $request);
        // $body    = emailBodyTemplate('NEW_USER_ADMIN_MAIL', $request);
        // $heading = emailHeadingTemplate('NEW_USER_ADMIN_MAIL', $request);
        // $adminMail = ['subject' => $subject, 'body' => $body, 'heading' => $heading];
        // Mail::to($request->email)->later(now()->addSeconds(15), new AdminNewUserMail($adminMail));
        return redirect()->route('login')->with('success', 'Registration Successfull!');
    }
    /**
     * Forgot password create
     *
     * @param \App\Models\User $token
     * @return \Illuminate\Http\Response
     */
    public function forgotPassword()
    {
        $this->setPageTitle('Forgot Password');
        $data['breadcrumb']  = ['Home' => url('/'), 'Forgot Password' => ''];
        return view('auth.reset-password',$data);
    }
    /**
     * Client password reset email sent
     *
     * @method POST
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Request Response
     */
    public function forgotPasswordSent(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            session()->flash('error', 'Failed! email is not registered.');
            return back();
        }
        $verify_code = Str::random(60);
        $user['verify_code'] = $verify_code;
        $user->save();

        $request['app_name']             = env('APP_NAME') ?? 'Laravel';
        $request['full_name'] = $user->fname . ' ' . $user->lname;
        $request['button_reset_url'] = URL::temporarySignedRoute('forgot.password.token', now()->addHours(1), ['token' => $verify_code]);
        $request['button_url'] = URL::temporarySignedRoute('forgot.password.token', now()->addHours(1), ['token' => $verify_code]);
        $request['button_reset_title'] = 'Click Here To Reset Password';

        // User mail
        $subject = emailSubjectTemplate('PASSWORD_RESET_MAIL', $request);
        $body    = emailBodyTemplate('PASSWORD_RESET_MAIL', $request);
        $heading = emailHeadingTemplate('PASSWORD_RESET_MAIL', $request);

        $userMail = ['subject' => $subject, 'body' => $body, 'heading' => $heading];
        Mail::to($user->email)->send(new PasswordResetMail($userMail));
        return redirect()->back()->with('success', 'Password reset link has been sent to your email');
    }

    /**
     * Forgot password verify
     *
     * @param \App\Models\User $token
     * @return \Illuminate\Http\Response
     */
    public function forgotPasswordToken(Request $request, $verify_token)
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }
        $data['user'] = User::where('verify_code', $verify_token)->first();
        if ($data['user']) {
            $this->setPageTitle('Password Update');
            $data['breadcrumb']  = ['Home' => url('/'), 'Forgot Password' => ''];
            return view('auth.update-password', $data);
        }
        return redirect()->route('forgot.password')->with('warning', 'Password reset link is expired');
    }
    /**
     * Change password
     * @param request
     * @return response
     */
    public function passwordUpdate(Request $request)
    {
        $this->validate($request, [
            'email'            => 'required',
            'password'         => 'required|min:8|max:20|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (!is_null($user->email_verified_at)) {
                $user['verify_code'] = '';
                $user['password'] = Hash::make($request->password);
                $user->save();
                Auth::logout();
                return redirect()->route('login')->with('success', 'Your password has been changed.');
            } else {
                session()->flash('error', 'Please! verify your email.');
            }
        } else {
            session()->flash('error', 'Something went wrong.');
        }
        return back();
    }
    /**
     * Email verified
     *
     * @param \App\Models\User $token
     * @return \Illuminate\Http\Response
     */
    public function verifiedCode(Request $request, $token){
        if (!$request->hasValidSignature()) {
            abort(401);
        }
        $emailVerifyCode = User::where('verify_code','=',$token)->first();
        if ($emailVerifyCode) {
            $emailVerifyCode->update([
                'email_verified_at' => Carbon::now()->format('Y-m-d h:i:s')
            ]);
            return redirect()->route('login')->with('success','Your email is verified.');
        }
        else{
            return redirect()->back()->with('Sorry your email cannot be identified.');
        }

    }
}
