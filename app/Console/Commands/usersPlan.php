<?php

namespace App\Console\Commands;

use App\Models\ClientsModel;
use App\Models\UsersModel;
use App\Src\Plans\PlanClient;
use Illuminate\Console\Command;

class usersPlan extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:plan';

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
        $this->info('Iniciando');

        $plan_client = new PlanClient();
        $users = ClientsModel::with('plan')->get();

        foreach ($users as $user) {
            if (!$user->plan) {
                dump($user->id);
                $plan_client->get($user->id);
            }
        }
    }
}
