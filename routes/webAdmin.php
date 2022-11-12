<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BoletosController;
use App\Http\Controllers\Admin\ClientsController;
use App\Http\Controllers\Admin\DocumentsController;
use App\Http\Controllers\Admin\FaqsController;
use App\Http\Controllers\Admin\FilesController;
use App\Http\Controllers\Admin\NeighborsController;
use App\Http\Controllers\Admin\Number_logsController;
use App\Http\Controllers\Admin\NumbersController;
use App\Http\Controllers\Admin\ParametersController;
use App\Http\Controllers\Admin\PaymentsController;
use App\Http\Controllers\Admin\PlansController;
use App\Http\Controllers\Admin\RaceController;
use App\Http\Controllers\Admin\SaquesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Middleware\AuthAdmin;
use App\Models\BoletosModel;
use App\Models\DocumentsModel;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::middleware(['auth', AuthAdmin::class])->group(function () {
    Route::prefix('admin')->middleware(AuthAdmin::class)->group(function () {
        Route::get('/', [AdminController::class, 'index']);
        Route::get('logout', [AdminController::class, 'logout']);

        Route::get('sobre', [AdminController::class, 'sobre']);
        Route::post('sobre', [AdminController::class, 'sobre_store']);

        Route::get('termos', [AdminController::class, 'termos']);
        Route::post('termos', [AdminController::class, 'termos_store']);

        Route::resource('balances', BalancesController::class);
        Route::post('balances/search', [BalancesController::class, 'search'])->name('balances.search');

        Route::get('clients/plan/select/{id_cliente}', [ClientsController::class, 'plan_select']);
        Route::post('clients/plan/select/{id_cliente}', [ClientsController::class, 'plan_select_post']);

        Route::get('clients/plan/block/{id_cliente}', [ClientsController::class, 'plan_block']);

        Route::post('clients/search', [ClientsController::class, 'search'])->name('clients.search');
        Route::get('clients/position/{position}', [ClientsController::class, 'position']);

        Route::get('clients/home/{id_cliente}', [ClientsController::class, 'home']);
        Route::get('clients/extract/{id_cliente}', [ClientsController::class, 'extract']);
        Route::get('clients/addBalance/{id_cliente}', [ClientsController::class, 'addBalance']);
        Route::post('clients/addBalance/{id_cliente}', [ClientsController::class, 'addBalanceStore']);
        Route::get('clients/pedidos/{id_cliente}', [ClientsController::class, 'pedidos']);
        Route::get('clients/patrocinador/{id_cliente}', [ClientsController::class, 'patrocinador']);
        Route::post('clients/patrocinador/{id_cliente}', [ClientsController::class, 'patrocinador_store']);
        Route::get('clients/financeiro/{id_cliente}', [ClientsController::class, 'financeiro']);
        Route::get('clients/financeiro/{id_cliente}/{boleto_id}', [ClientsController::class, 'financeiro_edit']);
        Route::post('clients/financeiro/{id_cliente}/{boleto_id}', [ClientsController::class, 'financeiro_edit_store']);
        Route::get('clients/pdf', [ClientsController::class, 'pdf']);
        Route::resource('clients', ClientsController::class);

        Route::resource('users', UsersController::class);
        Route::post('users/search', [UsersController::class, 'search'])->name('users.search');

        Route::resource('parameters', ParametersController::class);
        Route::post('parameters/search', [ParametersController::class, 'search'])->name('parameters.search');

        Route::resource('pacotes', PacotesController::class);
        Route::post('pacotes/search', [PacotesController::class, 'search'])->name('pacotes.search');

        // Route::get('purchases/ticket/{id_purchase}', function ($id_purchase) {
        // $ticket = PurchasesModel::find($id_purchase)->ticket;
        // return Storage::response('comprovantes/' . $ticket);
        // });

        Route::resource('notifications', NotificationsController::class);
        Route::post('notifications/search', [NotificationsController::class, 'search'])->name('notifications.search');

        Route::get('saques/pendentes', [SaquesController::class, 'pendentes']);
        Route::post('saques/confirm/{saque_id}', [SaquesController::class, 'confirm']);
        Route::resource('saques', SaquesController::class);
        Route::post('saques/search', [SaquesController::class, 'search'])->name('saques.search');

        Route::resource('documents', DocumentsController::class);
        Route::post('documents/search', [DocumentsController::class, 'search'])->name('documents.search');

        Route::get('documents/avaliation/{id_client}', [DocumentsController::class, 'avaliation']);
        Route::post('documents/active/{id_client}', [DocumentsController::class, 'active']);
        Route::post('documents/status', [DocumentsController::class, 'status']);
        Route::get('documents/download/{id_doc}', function ($id_doc) {
            $ticket = DocumentsModel::find($id_doc)->arquivo;
            return Storage::response($ticket);
        });

        Route::resource('files', FilesController::class);
        Route::post('files/search', [FilesController::class, 'search'])->name('files.search');

        // Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
        Route::get('/laravel', function () {
            return view('welcome');
        });

        Route::resource('cliente_plano', Cliente_planoController::class);
        Route::post('cliente_plano/search', [Cliente_planoController::class, 'search'])->name('cliente_plano.search');

        Route::get('boletos/download/{boleto_id}', function ($id_file) {
            $file = BoletosModel::find($id_file)->ticket;
            return Storage::response('comprovantes/' . $file);
        });
        Route::get('boletos/pdf', [BoletosController::class, 'pdf']);
        Route::get('boletos/pendentes', [BoletosController::class, 'pendentes']);
        Route::get('boletos/confirm/{boleto_id}', [BoletosController::class, 'confirm']);
        Route::post('boletos/confirm/{boleto_id}', [BoletosController::class, 'confirm_store']);
        Route::resource('boletos', BoletosController::class);
        Route::post('boletos/search', [BoletosController::class, 'search'])->name('boletos.search');

        Route::resource('compras', ComprasController::class);
        Route::post('compras/search', [ComprasController::class, 'search'])->name('compras.search');

        Route::resource('faqs', FaqsController::class);
        Route::post('faqs/search', [FaqsController::class, 'search'])->name('faqs.search');

        Route::resource('payments', PaymentsController::class);
        Route::resource('number_logs', Number_logsController::class);
        Route::resource('neighbors', NeighborsController::class);

        Route::get('numbers/edit/{number_id}', [NumbersController::class, 'edit']);
        Route::post('numbers/edit/{number_id}', [NumbersController::class, 'update']);
        Route::get('numbers/{neighbor_id}/{log_id}', [NumbersController::class, 'index']);
        // Route::resource('numbers', NumbersController::class);

        Route::get('race', [RaceController::class, 'index']);
        Route::get('race/{race_id}', [RaceController::class, 'index']);
        // Route::resource('race', RaceController::class);

        Route::get('imp', [AdminController::class, 'imp']);

        Route::get('plans/status', [PlansController::class, 'status']);
        Route::resource('plans', PlansController::class);

        Route::get('estrategia', [AdminController::class, 'estrategia']);
    });
});
