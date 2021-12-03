<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\CurrenyConversion;
use DB;
class ApiCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $amount = 1;

        $endpoint = 'convert';
        $access_key = '3e6beee7ebe8ecab1717e641cfe044ee';

        $ch = curl_init('https://api.exchangeratesapi.io/v1/convert?access_key=3e6beee7ebe8ecab1717e641cfe044ee&from=CAD&to=CAD&amount='.$amount.'');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// get the JSON data:
        $json = curl_exec($ch);
        curl_close($ch);

// Decode JSON response:
        $conversionResult = json_decode($json, true);

// access the conversion result
        $conversionResult['result'];



        // $exchangerate = round($conversionResult['result'], 0);

        $cad=  $conversionResult['result'];
        $exchangerate;
        $chs = curl_init('https://api.exchangeratesapi.io/v1/convert?access_key=3e6beee7ebe8ecab1717e641cfe044ee&from=CAD&to=USD&amount='.$amount.'');
        curl_setopt($chs, CURLOPT_RETURNTRANSFER, true);

// get the JSON data:
        $jsons = curl_exec($chs);
        curl_close($chs);

// Decode JSON response:
        $conversionResults = json_decode($jsons, true);

// access the conversion resultss
        $conversionResults['result'];



        // $exchangerates = round($conversionResults['result'], 0);


        $usd=  $conversionResults['result'];
// DB::table('curreny_conversions')->insert(
//     ['cad' => $cad, 'usd' => $usd]
// );
        $data=CurrenyConversion::count();

        if($data>=1){
           $objaddress = CurrenyConversion::first()->delete();
           $objaddress = new CurrenyConversion();
           $objaddress->cad = $cad;
           $objaddress->usd = $usd;

           $objaddress->save();
            // $objaddress->cad = $cad;
            // $objaddress->usd = $usd;

            // $objaddress->save();
       }
       else{
         $objaddress = new CurrenyConversion();
         $objaddress->cad = $cad;
         $objaddress->usd = $usd;

         $objaddress->save();
     } 

 }
}
