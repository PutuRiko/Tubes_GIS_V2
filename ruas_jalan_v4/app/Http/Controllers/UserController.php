<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class UserController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        try {
            $token = $request->input('token');
        
            $client = new Client();
        
            $response = $client->post('https://gisapis.manpits.xyz/api/register', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept'        => 'application/json',
                    'Content-Type'  => 'application/json',
                ],
                'json' => [
                    'name'     => $request->input('name'),
                    'email'    => $request->input('email'),
                    'password' => $request->input('password'),
                ],
            ]);
        
            $body = $response->getBody();
            $content = $body->getContents();

            return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $content = $response->getBody()->getContents();
                return response()->json(['error' => json_decode($content)->message], $response->getStatusCode());
            } else {
                return response()->json(['error' => 'Failed to connect to the server.'], 500);
            }
        }
    }
    
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        try {
            $client = new Client();
    
            $response = $client->post('https://gisapis.manpits.xyz/api/login', [
                'json' => [
                    'email'    => $request->input('email'),
                    'password' => $request->input('password'),
                ],
            ]);
    
            $content = $response->getBody()->getContents();
            $userData = json_decode($content);
    
            if (isset($userData->meta->token)) {
                // Simpan token dalam session
                $request->session()->put('api_token', $userData->meta->token);
                return redirect()->route('layout')->with('success', 'Login successful!');
            }
    
            return redirect()->back()->with('error', 'Failed to retrieve authentication token.');
    
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $content = $response->getBody()->getContents();
                return redirect()->back()->with('error', json_decode($content)->message);
            } else {
                return redirect()->back()->with('error', 'Failed to connect to the server.');
            }
        }
    }
    
    public function logout(Request $request)
    {
        try {
            $token = $request->session()->get('token');
    
            $client = new \GuzzleHttp\Client();
            $response = $client->post('https://gisapis.manpits.xyz/api/logout', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept'        => 'application/json',
                ],
            ]);
    
            // Hapus token dari session
            $request->session()->forget('token');
    
            // Redirect ke halaman login dengan pesan sukses
            return redirect()->route('index')->with('success', 'Logged out successfully.');
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $content = $response->getBody()->getContents();
                $decodedContent = json_decode($content);
                $errorMessage = $decodedContent->message ?? 'An error occurred';
    
                return redirect()->route('login')->withErrors(['msg' => $errorMessage]);
            } else {
                return redirect()->route('login')->withErrors(['msg' => 'Failed to connect to the server.']);
            }
        }
    }

    public function showLayout()
    {
        return view('layout');
    }
}
