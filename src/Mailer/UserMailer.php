<?php

namespace App\Mailer;

use Cake\Mailer\Mailer;

class UserMailer extends Mailer
{
    public function welcome($user) // mail de bienvenue
    {
        $this
            ->to($user->email)
            ->subject(sprintf('[Instatux] Bienvenue %s', $user->username)) // titre du mail
            ->emailFormat('html')
            ->viewVars([   // variables

                            'username'=> $user->username
                        ])
            ->setTemplate('bienvenue')
            ->setLayout('mail');
    }

    public function resetPassword($user)
    {
        $this
            ->to($user->email)
            ->subject('Reset password')
            ->set(['token' => $user->token]);
    }

    public function deleteaccount($user)
    {
                $this
            ->to($user->email)
            ->subject(sprintf('[Instatux] Compte supprimé')) // titre du mail
            ->emailFormat('html')
             ->viewVars([   // variables

                            'username'=> $user->username
                        ])
            ->setTemplate('delete')
            ->setLayout('mail');
    }
}

?>