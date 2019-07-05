<?php

namespace App\Listeners;

use App\Error;
use App\Events\SongUploaded;
use GuzzleHttp\RequestOptions;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use GuzzleHttp\Client;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

class SendHashRequest /*implements ShouldQueue*/
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SongUploaded  $event
     * @return void
     */
    public function handle(SongUploaded $event)
    {
        $id = $event->id;
        $file_path = $event->file_path;

//        dd($file_path);

        $client = new Client();
        $promise = $client->postAsync('localhost:8080/rms/register', [
            'json' => [
                'songId' => $id,
                'path' => $file_path
            ]
        ])->then(
            function (ResponseInterface $res) use ($id){
                $response = $res->getStatusCode();

            },
            function (RequestException $e){
                $message = $e->getMessage();
                $method = $e->getRequest()->getMethod();
                $error = new Error;
                $error->message = $message.", METHOD: ".$method.", BODY: ".$e->getRequest()->getBody();
                $error->save();
            }
        );

        $response = $promise->wait();
    }
}
