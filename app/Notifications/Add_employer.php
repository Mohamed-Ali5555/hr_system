<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

use App\Models\Employeer;
class Add_employer extends Notification
{
    use Queueable;
    private $employer_id;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Employeer $employer_id)
    {
        $this->employer_id = $employer_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        return [
            //  'data' => $this->details['body']
 
            'id'=> $this->employer_id->id,
            'title'=>'تم اضافة موظف جديد بواسطة :',
            'user'=> Auth::user()->name,
         ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */

}
