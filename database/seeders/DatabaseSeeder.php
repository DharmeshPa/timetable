<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Venue;
use App\Models\Event;
use App\Models\Location;
use App\Models\Theme;
use App\Models\Display;
use App\Models\Timetable;
use App\Models\Role;
use App\Models\Crew;
use App\Models\Content;
use App\Models\Topic;
use App\Models\Message;
use App\Models\Video;
use App\Models\Graphic;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Theme::factory(1)->create();

        $role1 = Role::create([
            'title'=>'Event Director'
        ]);

        $role2 = Role::create([
            'title'=>'Editor'
        ]);

        $role3 = Role::create([
            'title'=>'Camera Op'
        ]);
        
        $role4 = Role::create([
            'title'=>'Production Assistant'
        ]);

        $role5 = Role::create([
            'title'=>'Technical Manager'
        ]);

        $role6 = Role::create([
            'title'=>'B/O Technician'
        ]);

        $adrian = Crew::create([
            'name' => 'Adrian Worrall',
            'email'=>'adrian@cyphermedia.co.uk',
        ]);

        $chris = Crew::create([
            'name' => 'Chris Reddall',
            'email'=>'chris@cyphermedia.co.uk',
        ]);

        $jake = Crew::create([
            'name' => 'Jake Carless',
            'email'=>'jake@cyphermedia.co.uk',
        ]);
        $stuart = Crew::create([
            'name' => 'Stuart Almond',
            'email'=>'stuart@cyphermedia.co.uk',
        ]);

        $chrisP = Crew::create([
            'name' => 'Chris Perkins',
            'email'=>'c.perkins@cue.events',
        ]);

        $tim = Crew::create([
            'name' => 'Tim James',
            'email'=>'',
        ]);
        $robin = Crew::create([
            'name' => 'Robin Coulthard',
            'email'=>'',
        ]);

        $Craig = Crew::create([
            'name' => 'Craig Ewan',
            'email'=>'',
        ]);

        $Daisy = Crew::create([
            'name' => 'Daisy Triance',
            'email'=>'',
        ]);

        $Daniel = Crew::create([
            'name' => 'Daniel Parkinson',
            'email'=>'',
        ]);

        $Darnell = Crew::create([
            'name' => 'Darnell Hamilton',
            'email'=>'',
        ]);
        $Dave = Crew::create([
            'name' => 'Dave Walker',
            'email'=>'',
        ]);
        $Gary = Crew::create([
            'name' => 'Garry Moore',
            'email'=>'',
        ]);

        $Gareth = Crew::create([
            'name' => 'Gareth Brierley',
            'email'=>'',
        ]);

        $role7 = Role::create([
            'title'=>'Video Tech'
        ]);
        $Alexander = Crew::create([
            'name' => 'Alexander Whitby',
            'email'=>'',
        ]);
        $Alexander->roles()->attach($role7);


        $role8 = Role::create([
            'title'=>'Set Builder'
        ]);
        $Barry = Crew::create([
            'name' => 'Barry Sims',
            'email'=>'',
        ]);
        $Barry->roles()->attach($role8);

        $role9 = Role::create([
            'title'=>'Sound No. 1'
        ]);
        $Dewi = Crew::create([
            'name' => 'Dewi Jones',
            'email'=>'',
        ]);
        $Dewi->roles()->attach($role9);



        $adrian->roles()->attach($role1);
        $chris->roles()->attach($role2);
        $stuart->roles()->attach($role3);
        $jake->roles()->attach($role4);
        $chrisP->roles()->attach($role5);
        $tim->roles()->attach($role3);
        $robin->roles()->attach($role3);

        $Craig->roles()->attach($role6);
        $Daisy->roles()->attach($role6);
        $Daniel->roles()->attach($role6);
        $Darnell->roles()->attach($role6);
        $Dave->roles()->attach($role6);
        $Gary->roles()->attach($role6);
        $Gareth->roles()->attach($role6);


        Venue::create([
            'name' =>'Amsterdam, Netherlands'
        ]);

        Venue::create([
            'name' =>'Paris, France'
        ]);

        Venue::create([
            'name' =>'Barcelona, Spain'
        ]);

        Venue::create([
            'name' =>'Berlin, Germany'
        ]);

        Venue::create([
            'name' =>'Madrid, Spain'
        ]);

        Venue::create([
            'name' =>'Lisbon, Portugal'
        ]);

        Venue::create([
            'name' =>'Noordwijk, Netherlands'
        ]);

        Venue::create([
            'name' =>'Rome, Italy'
        ]);

        Venue::create([
            'name' =>'Prague'
        ]);

        Venue::create([
            'name' =>'Dublin'
        ]);

        User::create([
            'name' => 'Dharmesh',
            'email' => 'dharmesh@cyphermedia.co.uk',
            'password'=>'Cypher@1945'
        ]);

        User::create([
            'name' => 'Chris',
            'email' => 'chris@cyphermedia.co.uk',
            'password'=>'Cypher@1945'
        ]);

        User::create([
            'name' => 'Stuart',
            'email' => 'stuart@cyphermedia.co.uk',
            'password'=>'Cypher@1945'
        ]);

        User::create([
            'name' => 'Adrian',
            'email' => 'adrian@cyphermedia.co.uk',
            'password'=>'Cypher@1945'
        ]);

        User::create([
            'name' => 'Jake',
            'email' => 'jake@cyphermedia.co.uk',
            'password'=>'Cypher@1945'
        ]);
    }
}