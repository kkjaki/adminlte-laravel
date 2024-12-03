<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chatbot;

class ChatbotController extends Controller
{
    /**
     * Display the chatbot page.
     * Only necessary if the chatbot is on a separate page.
     */
    public function index()
    {
        $quickQuestions = Chatbot::pluck('question');
        return view('chatbot', compact('quickQuestions'));
    }

    /**
     * Handle the user's message and return a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getReply(Request $request)
    {
        // Get the user message from the request and normalize it
        $message = strtolower(trim($request->input('message')));

        // Search for the question in the chatbot table
        $reply = Chatbot::where('question', 'LIKE', "%{$message}%")->value('replies');

        // Return the appropriate response
        if ($reply) {
            return response()->json(['response' => $reply]);
        } else {
            return response()->json(['response' => 'Maaf, saya tidak memahami pertanyaan Anda.']);
        }
    }
}