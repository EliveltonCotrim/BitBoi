<?php

namespace App\Console\Commands;

use App\Models\ClientsModel;
use App\Models\UsersModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class usersClient extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:users';

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
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        $this->info('Iniciando Scaf');

        $clients = ClientsModel::get();
        foreach ($clients as $client) {
            $insert = [
                'name' => $client->name,
                'email' => $client->email,
                'password' => $client->password,
                'client_id' => $client->id,
            ];
            UsersModel::insert($insert);
        }
    }
}
