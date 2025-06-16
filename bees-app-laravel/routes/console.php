<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Notification;
use App\Models\Aktivnost;
use App\Notifications\Notifikacija;

Artisan::command('aktivnosti:posalji-notifikacije-sutra', function () {
    $sutra = now()->addDay()->toDateString(); 

    $aktivnosti = \App\Models\Aktivnost::whereDate('pocetak', $sutra)
        ->where('notifikacija_poslata', false)
        ->get();

    if ($aktivnosti->isEmpty()) {
        $this->warn("Nema aktivnosti za sutra.");
        return;
    }

    foreach ($aktivnosti as $aktivnost) {
        $user = $aktivnost->user ?? null;

        if ($user) {
            $user->notify(new \App\Notifications\Notifikacija($aktivnost));
            $aktivnost->notifikacija_poslata = true;
            $aktivnost->save();

            $this->info("Notifikacija poslata korisniku ID {$user->id} za aktivnost '{$aktivnost->naziv}'");
        } else {
            $this->warn("Nema korisnika za aktivnost ID {$aktivnost->id}");
        }
    }
});

