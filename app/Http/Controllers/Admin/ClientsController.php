<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BalancesModel;
use App\Models\BoletosModel;
use App\Models\Client_planModel;
use App\Models\ClientsModel;
use App\Models\PlansModel;
use App\Models\UsersModel;
use App\Repositories\ClientsRepository;
use App\Src\Plans\PlanClient;
use App\Src\Utils\Utils;
use App\Transactions\Balance;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class ClientsController extends Controller {

    private $dados;
    private $clients;

    public function __construct(ClientsModel $clients) {
        $this->clients = $clients;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ClientsRepository $clientsRepository) {
        $filters = $request->except(['_token']);
        $this->dados['filters'] = $filters;

        $this->dados['clients'] = UsersModel::where('type', 'client')
            ->where(function ($query) use ($filters) {
                if (isset($filters['name']) && $filters['name'] != '')
                    $query->where('name', 'like',  "%" . $filters['name'] . "%");

                if (isset($filters['user']) && $filters['user'] != '')
                    $query->where('user', 'like',  "%" . $filters['user'] . "%");

                if (isset($filters['email']) && $filters['email'] != '')
                    $query->where('email', 'like',  "%" . $filters['email'] . "%");

                if (isset($filters['id']) && $filters['id'] != '')
                    $query->where('id', $filters['id']);

                if (isset($filters['cpf']) && $filters['cpf'] != '')
                    $query->where('cpf', $filters['cpf']);
            })
            ->orderBy('name')
            ->paginate();

        return view('admin.clients.clients_list', $this->dados);
    }

    /**
     * Search results
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function pdf(Request $request, ClientsRepository $clientsRepository) {

        $filters = $request->except(['_token']);
        $this->dados['filters'] = $filters;

        $this->dados['clients'] = $clientsRepository->getByStatus($filters, $request->all())->get();

        $html = view('admin.clients.clients_pdf', $this->dados)->render();

        return PDF::setOptions(['isRemoteEnabled' => true])
            ->loadHTML($html)
            ->setPaper('a4')
            ->setWarnings(true)
            ->stream();
    }

    public function position($position) {
        $this->dados['clients'] = $this->clients
            ->where('position', $position)
            ->paginate(10);
        $this->dados['position'] = $position;
        return view('admin.clients.clients_list', $this->dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $this->dados['titulo'] = 'clients';
        return view('admin.clients.clients_create', $this->dados);
    }

    public function store(Request $request) {
        $insert = [
            'name' => $request->name,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'password' => Hash::make($request->password),
        ];

        $this->clients->create($insert);
        return redirect('admin/clients');
    }

    public function show($id) {
        if (!$clients = $this->clients->find($id)) {
            return redirect()->back();
        }

        $this->dados['titulo'] = 'clients';
        $this->dados['clients'] = $clients;
        return view('admin.clients.clients_show', $this->dados);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\{clients}Model  $clients
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $clients = $this->clients->find($id);
        $this->dados['clients'] = $clients;
        $this->dados['titulo'] = 'clients';
        return view('admin.clients.clients_edit', $this->dados);
    }

    public function update(Request $request, $id) {
        $this->clients->find($id)->update($request->all());
        return redirect('admin/clients');
    }

    public function delete(Request $request, $id) {
        if ($request->isMethod('post')) {
            $input = $request->except(['_token']);
            clientsModel::where('id', $id)->delete();
            return redirect('/admin/clients');
        } else {
            $clients = clientsModel::where('id', $id)->first();
            $this->dados['clients'] = $clients;
            $this->dados['titulo'] = 'clients';
            return view('admin/clients.clients_delete', $this->dados);
        }
    }

    public function home($id_cliente) {
        $this->dados['client'] = $this->clients->find($id_cliente);
        return view('admin.clients.clients_home', $this->dados);
    }

    public function extract(BalancesModel $balancesModel, $id_cliente) {
        $this->dados['extracts'] = $balancesModel->where('client_id', $id_cliente)->get();
        $this->dados['client'] = $this->clients->find($id_cliente);
        return view('admin.clients.clients_extract', $this->dados);
    }

    public function patrocinador($id_cliente) {
        $this->dados['client'] = UsersModel::find($id_cliente);

        $this->dados['clients'] = UsersModel::orderBy('name')
            ->pluck('name', 'id');

        return view('admin.clients.clients_patrocinador', $this->dados);
    }

    public function financeiro($id_cliente) {
        $this->dados['client'] = UsersModel::find($id_cliente);

        // $planCliente = new PlanClient();
        // $this->dados['plan_client'] = $planCliente->get($id_cliente);
        $this->dados['boletos'] = BoletosModel::where('user_id', $id_cliente)
            ->latest()
            ->get();

        return view('admin.clients.clients_financeiro', $this->dados);
    }

    public function patrocinador_store(Request $request, $id_cliente) {
        $update = [
            // "indicado" => $request->indicado,
            "name" => $request->nome,
            "user" => $request->user,
            "email" => $request->email,
            // "status" => $request->status,
            "cpf" => $request->cpf,
            "cell" => $request->phone,
            "codigo_assas" => $request->codigo_assas,
        ];

        if ($request->senha != '') {
            $password = Hash::make($request->senha);
            $update['password'] = $password;
            UsersModel::find($id_cliente)->update(['password' => $password]);
        }

        // dd($update);

        UsersModel::find($id_cliente)->update($update);
        return redirect('admin/clients/patrocinador/' . $id_cliente)->with('alert', 'Dados Alterados');
    }

    public function addBalance($id_cliente) {
        $this->dados['client'] = $this->clients->find($id_cliente);
        return view('admin.clients.clients_addBalance', $this->dados);
    }

    public function addBalanceStore(Request $request, $id_cliente) {
        $value = Utils::moeda($request->valor);
        Balance::credit($id_cliente, $value, 'rs', 'credito');

        return redirect('admin/clients/extract/' . $id_cliente)->with('alert', 'Saldo Adicionado');
    }

    public function plan_block($client_id) {
        $client_plan = Client_planModel::where('client_id', $client_id)
            ->first()
            ->update(['expiration' => null]);

        return redirect('admin/clients/financeiro/' . $client_id)->with('alert', 'Plano Desativado');
    }

    public function plan_select($client_id) {
        $this->dados['plans'] = PlansModel::where('status', 'ativo')->get()->pluck('name', 'id');
        $this->dados['client'] = $this->clients->find($client_id);
        return view('admin.clients.plan_select', $this->dados);
    }

    public function plan_select_post(Request $request, $client_id) {
        $plan_id = $request->plan;
        $plan = PlansModel::findOrFail($plan_id);

        $insert = [
            'client_id' => $client_id,
            'tipo' => 'adm',
            'meioPagamento' => $request->meio,
            'valor' => $plan->value,
            'created_at' => now(),
            'dataConfirmacao' => now(),
            'status' => 'confirmado',
        ];
        $deposit_id = BoletosModel::insertGetId($insert);
        $client_plan = Client_planModel::where('client_id', $client_id)->first();

        $planClient = new PlanClient();
        $planClient->update($client_plan->id, $plan->days);

        return redirect('admin/clients/financeiro/' . $client_id)->with('alert', 'Plano Ativado');
    }

    public function financeiro_edit($client_id, $boleto_id) {
        $this->dados['client_id'] = $client_id;
        $this->dados['client'] = $this->clients->find($client_id);
        $this->dados['boleto'] = BoletosModel::find($boleto_id);
        return view('admin.clients.financeiro_edit', $this->dados);
    }

    public function financeiro_edit_store(Request $request, $client_id, $boleto_id) {
        BoletosModel::find($boleto_id)->update(['status' => $request->status]);
        return redirect('admin/clients/financeiro/' . $client_id)->with('alert', 'Pagamento Alterado');
    }
}
