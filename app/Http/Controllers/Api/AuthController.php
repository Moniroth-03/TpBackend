<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller; // Make sure to import the base Controller class
use Illuminate\Http\Request;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Passport\Passport;

class AuthController extends Controller
{
    /**
     * Register a new user.
     * 
     * @OA\Post(
     *     path="/api/register",
     *     tags={"Authentication"},
     *     summary="Register a new user",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email", "password"},
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="password", type="string", format="password")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Registration successful"
     *     )
     * )
     */
    public function register(Request $request)
    {

        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|confirmed|min:8',
        // ]);

        // Create a new user instance
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Generate a 6-digit OTP code
        $otpCode = random_int(100000, 999999);
        $user->otp_code = $otpCode;
        $user->save();
        $activateLink = 'http://0.0.0.0/api/verify-otp?user_id='.$user->id.'&code='.$otpCode; 
        Mail::to($user->email)->send(new OtpMail($activateLink));

        // Debugging statement
        \Log::info('Email sent to: ' . $user->email);
    

        // Return a response indicating successful registration and OTP sent
        return response()->json([
            'message' => 'Registration successful! Please check your email for the verification code.',
        ]);
    }


    /**
     * Verify the OTP for user registration.
     * 
     * @OA\Get(
     *     path="/api/verify-otp",
     *     tags={"Authentication"},
     *     summary="Verify OTP for user registration",
     *     @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         required=true,
     *         description="User ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="code",
     *         in="query",
     *         required=true,
     *         description="OTP code",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OTP verification successful"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found or invalid link"
     *     )
     * )
     */

    public function verifyOTP(Request $request)
    {
        // 1. Retrieve the OTP code and user ID from the request parameters
        $code = $request->query('code');
        $userId = $request->query('user_id');
    
        // Debugging
        \Log::info('Received code: ' . $code);
        \Log::info('Received user_id: ' . $userId);
    
        // 2. Retrieve the stored OTP code from the database or any other storage mechanism
        $user = User::find($userId);
    
        // Debugging
        \Log::info('Retrieved user: ' . json_encode($user));
    
        if (!$user) {
            // Debugging
            \Log::info('User not found');
            // User not found
            return response()->json(['error' => 'User not found.'], 404);
        }
    
        $storedCode = $user->otp_code; // Assuming you have a column 'otp_code' in your users table
    
        // Debugging
        \Log::info('Stored code: ' . $storedCode);
    
        // 3. Validate the codes
        if ($code === $storedCode) {
            // 4. Mark the user's email as verified
            // $user->email_verified_at = now();
            $user->save();
    
            // 5. Return a success response
            return response()->json(['message' => 'Email verified successfully!']);
        } else {
            // Debugging
            \Log::info('Invalid code');
            // 6. Return an error response
            return response()->json(['error' => 'Invalid link. You may attempt to register again.'], 404);
        }
    }

    /**
     * Login a user.
     * 
     * @OA\Post(
     *     path="/api/login",
     *     tags={"Authentication"},
     *     summary="Login a user",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="password", type="string", format="password")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login successful"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Invalid email or password"
     *     )
     * )
     */
    public function login(Request $request)
    {
        // Validate user input
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Attempt to find the user with the given email
        $user = User::where('email', $request->email)->first();

        // Check if the user exists and the email is verified
        if ($user && Hash::check($request->password, $user->password)) {
            // Generate a personal access token using Laravel Passport
            $token = $user->createToken('auth_token')->accessToken;

            // Return a successful response with the generated token
            return response()->json([
                'message' => 'Login successful!',
                'access_token' => $token,
            ], 200);
        } else {
            // Return a forbidden error if credentials are invalid
            return response()->json([
                'message' => 'Invalid email or password',
            ], 403);
        }
    }
}
