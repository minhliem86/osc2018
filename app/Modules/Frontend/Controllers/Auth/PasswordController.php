<?php namespace App\Modules\Frontend\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Ollieread\Multiauth\Passwords\PasswordBroker;

use Validator;
use Auth;
use App\Models\Customer;
use Illuminate\Http\Request;

class PasswordController extends Controller {

<<<<<<< HEAD
	protected $redirectPath = 'admin/dashboard';
	protected $redirectPath = 'dang-nhap';
=======
	protected $redirectPath = 'dang-xuat';
>>>>>>> dae7603be7219d88d6c10736d5705009d3bed9ab

	/*
	|--------------------------------------------------------------------------
	| Password Reset Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling password reset requests
	| and uses a simple trait to include this behavior. You're free to
	| explore this trait and override any methods you wish to tweak.
	|
	*/

	use ResetsPasswords;

	/**
	 * Create a new password controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\PasswordBroker  $passwords
	 * @return void
	 */

	public function __construct()
	{
		// $this->auth = $auth;
		$this->auth = Auth::client();
		// $this->passwords = $passwords;
		$this->passwords = Password::client();

		$this->middleware('customer_logined');
	}

	public function getEmail()
	{
		return view('Frontend::auth.passwords.email');
	}

	/**
	 * Send a reset link to the given user.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function postEmail(Request $request)
	{
		$this->validate($request, ['email' => 'required|email']);

		$response = $this->passwords->sendResetLink($request->only('email'), function($m)
		{
			$m->subject($this->getEmailSubject());
		});

		switch ($response)
		{
			case PasswordBroker::RESET_LINK_SENT:
				return redirect()->back()->with('status', 'Chúng tôi đã gửi một email khôi phục mật khẩu bạn. Vui lòng kiểm tra email và làm theo hướng dẫn.');

			case PasswordBroker::INVALID_USER:
				return redirect()->back()->withErrors(['email' => 'Chúng tôi không tìm thấy user với địa chỉ email trên.']);
		}
	}

	/**
	 * Get the e-mail subject line to be used for the reset link email.
	 *
	 * @return string
	 */
	protected function getEmailSubject()
	{
		return isset($this->subject) ? $this->subject : 'Your Password Reset Link';
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset(Request $request, $token = null)
	{
		if (is_null($token))
		{
			throw new NotFoundHttpException;
		}
		return view('Frontend::auth.passwords.reset')->with('token', $token);
	}

	/**
	 * Reset the given user's password.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function postReset(Request $request)
	{
		$this->validate($request, [
			'token' => 'required',
			'email' => 'required|email',
			'password' => 'required|confirmed',
		]);

		$credentials = $request->only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = $this->passwords->reset($credentials, function($user, $password)
		{
			$user->password = bcrypt($password);

			$user->save();

			$this->auth->login($user);
		});

		switch ($response)
		{
			case PasswordBroker::PASSWORD_RESET:
				return redirect($this->redirectPath());

			default:
				return redirect()->back()
							->withInput($request->only('email'))
							->withErrors(['email' => trans($response)]);
		}
	}

	/**
	 * Get the post register / login redirect path.
	 *
	 * @return string
	 */
	public function redirectPath()
	{
		if (property_exists($this, 'redirectPath'))
		{
			return $this->redirectPath;
		}

		return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
	}

}
