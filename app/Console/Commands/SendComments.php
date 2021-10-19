<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;

class SendComments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'comments:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Emails comments of the day to all admins';

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
     * @return int
     */
    public function handle()
    {
       //Get all admins 
       $admins = User::whereRoleIs('admin')->get();
       //Get all today comments 
       $comments = Review::whereDate('created_at', Carbon::today())->get();
       //Send email to all admins
       foreach ($admins as $admin) {
           //NB:This function can be moved to Queues and sent with template
            Mail::raw("{$comments}", function ($mail) use ($admin) {
                $mail->from('info@productapp.com');
                $mail->to($admin->email)
                    ->subject('Comments of the day');
            });
        }
        $this->info('Comments sent!');
    }
}
