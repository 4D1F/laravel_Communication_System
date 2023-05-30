<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;

class BotManController extends Controller
{
     /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');

        $botman->hears('{message}', function ($botman, $message) {

            if ($message == 'hi' || $message == 'Hi' || $message == 'HI') {
                $this->askName($botman);
                
            } elseif ($message == 'Q1' || $message == 'q1'){
                $botman->reply('Yes, we have class tomorrow');
            }
            elseif ($message == 'Q2' || $message == 'q2'){
                $botman->reply('Department of CSE is on the 3rd floor');
            }
            elseif ($message == 'Q3' || $message == 'q3'){
                $botman->reply('CSE Lab is on the 11th floor');
            }           
            elseif ($message == 'Thanks' || $message == 'thanks' || $message == 'THANKS' || $message == 'Thank you' || $message == 'thank you' || $message == 'tnx' || $message == 'Tnx' || $message == 'TNX' || $message == 'Thank you!' || $message == 'thank you!' || $message == 'tnx!' || $message == 'Tnx!' || $message == 'TNX!'){
                $botman->reply('CSE Lab is on the 11th floor');
            }           
            else {
                $botman->reply("<br>I can answer the following queries: <br>
                Q1. Do we have class tomorrow? <br>
                Q2. Which floor is the department of CSE? <br>
                Q3. Where is the CSE Lab? <br>
                etc...  ");
            }
        });

        $botman->listen();
    }

    /**
     * Place your BotMan logic here.
     */
    
    public function askName($botman) 
    {

        $botman->ask('Hello! What is your Name?', function (Answer $answer) {
            
            $name = $answer->getText();

            $this->say('Nice to meet you ' . $name.'<br>I can answer the following queries: <br>
            Q1. Do we have class tomorrow? <br>
            Q2. Which floor is the department of CSE? <br>
            Q3. Where is the CSE Lab? <br>
            etc...  ');
            

        });
    }
}
