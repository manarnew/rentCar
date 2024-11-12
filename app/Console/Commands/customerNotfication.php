<?php

namespace App\Console\Commands;

use App\Models\Contracts;
 use App\Models\Panel_settings;
use Illuminate\Console\Command;



class ScreeningInterviewCommand extends Command
{
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customer:notfiaction';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
    $today =date('Y-m-d');
        $data = Contracts::whereDate("return_date", "=", $today)->where('contract_status',3)->get();
        $Panel_settings = Panel_settings::find(1);
        // Ensure you have a valid access token
        $access_token =  $Panel_settings->access_token; // Replace with a valid access token
        $instance_id =  $Panel_settings->Inctance_id;
        $message = "اخطار بنتهاء الحجز اليوم";
        foreach ($data as $info) {
       
        $url = "https://waclient.com/api/send?number={$info->customer->phone}&type=text&message=$message&instance_id=$instance_id&access_token=$access_token";
        
        // Use cURL or file_get_contents to send the request if necessary
        $response = file_get_contents($url); // or use cURL for more robust handling
       $response =  json_decode($response);
        if($response->status == "success"){
                    return redirect()->back()->with(['success' => 'تم ارسال البيانات بنجاح']);
        }else{
            return redirect()->back()->with(['error' => 'لم يتم ارسال البيانات راجع الرقم المرسل الية']);
        }
        }
    }
}
