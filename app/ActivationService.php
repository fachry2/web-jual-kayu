<?php
namespace App;
use App\Notifications\ConfirmUserEmail;
use Mail;

class ActivationService{
    protected $activationRepo;
    protected $resendAfter = 24;
    public function __construct(ActivationRepository $activationRepo){
        $this->activationRepo = $activationRepo;
    }
    public function sendActivationMail($user){
        if($user->activated || !$this->shouldSend($user)){
            return;
        }
        $token = $this->activationRepo->createActivation($user);
        $link = route('user.activate', $token);
        $data = ['link' => $link];
        //$user->notify(new ConfirmUserEmail($token));

        Mail::send(['html' => 'send_activation_code'], $data, function($message) use ($user)
        {
            $message->to($user->email)->subject('Furniture Activation Account');
            $message->from('m.alpandi57@gmail.com', 'FURNITURE');
        });
    }
    public function activateUser($token){
        $activation = $this->activationRepo->getActivationByToken($token);
        if($activation === null){
            return null;
        }
        $user = User::find($activation->user_id);
        $user->activated = true;
        $user->save();
        $this->activationRepo->deleteActivation($token);
        return $user;
    }
    private function shouldSend($user){
        $activation = $this->activationRepo->getActivation($user);
        return $activation === null || strtotime($activation->created_at) + 60 * 60 * $this->resendAfter < time();
    }
}