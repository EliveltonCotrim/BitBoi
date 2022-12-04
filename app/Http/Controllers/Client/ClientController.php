<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestTermoUser;
use App\Models\BalancesModel;
use App\Models\BoletosModel;
use App\Models\ClientsModel;
use App\Models\Coins;
use App\Models\ComprasModel;
use App\Models\CotacaoMoeda;
use App\Models\FaqsModel;
use App\Models\FilesModel;
use App\Models\ParametersModel;
use App\Models\PaymentsModel;
use App\Models\PlansModel;
use App\Models\Purchases;
use App\Models\RendimentosPagos;
use App\Models\SaquesModel;
use App\Models\User;
use App\Models\UsersModel;
use App\Src\Plans\PlanClient;
use App\Src\Rede\Unilevel;
use App\Src\Transactions\Balance;
use App\Src\Utils\Utils;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

use function GuzzleHttp\Promise\all;

class ClientController extends Controller
{
    private $dados = [];
    private $user_id;
    private $clientesmodel;

    public function __construct(ClientsModel $clientesmodel)
    {
        $this->clientesmodel = $clientesmodel;

        $this->middleware(function ($request, $next) {
            $this->user_id = auth()->user()->id;
            return $next($request);
        });
    }


    // public function check() {
    //     $token = session('token');
    //     Auth::logoutOtherDevices($token);
    //     session()->forget('token');
    //     return redirect('client');
    // }

    public function index(BoletosModel $boletos, Balance $balances)
    {
        $saldo_tokens = $boletos
            ->where('user_id', $this->user_id)
            ->where('status', 'confirmado')
            ->sum('quantity');

        $compras = Purchases::where('client_user_id', $this->user_id)
        ->where('status', 'confirmada')->get();

        $boletos = BoletosModel::where('user_id', $this->user_id)->where('status', 'confirmado')->get();

      
        $saldo_investimento = $balances->balances($this->user_id, 'investimento');
        $rendimentoatual = $balances->balances($this->user_id, 'rendimento');

        // dd($saldo_investimento, $rendimentoatual);


        $rendimentoatual = BalancesModel::where('coin', 'rendimento')
        ->where('user_id', $this->user_id)
        ->latest()->first();

        $lucroPrevisto = 0;
        foreach ($boletos as $key => $value) {
            $lucroPrevisto +=  (($value->valor * $value->purchase->percentual_rendimento) / 100) * $value->purchase->time_pri;
        }

        $coins = Coins::where('status', 'active')->get();

        $cotacoes = CotacaoMoeda::orderBy('created_at', 'ASC')->get();
        $this->dados['saldo_moedas'] = $compras->sum('quantity_coin');
        $this->dados['valorInvestido'] =  $saldo_investimento;
        $this->dados['lucroPrevisto'] = $lucroPrevisto;
        $this->dados['rendimentoatual'] = $rendimentoatual;
        $this->dados['cotacoes'] = $cotacoes;
        $this->dados['coins'] = $coins;

        return view('client.home_client', $this->dados);
    }

    public function faq()
    {
        $faqs = FaqsModel::get();
        return view('client.faq', compact('faqs'));
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }

    public function minha_rede()
    {
        $unilevel = new Unilevel();
        $this->dados['rede'] = $unilevel->getAll($this->id_cliente);
        return view('client.minha_rede', $this->dados);
    }

    public function diretos()
    {
        $unilevel = new Unilevel();
        $this->dados['rede'] = $unilevel->diretos($this->id_cliente);
        return view('client.diretos', $this->dados);
    }

    public function meus_dados()
    {
        $userClient = UsersModel::find($this->user_id);
        $cliente = ClientsModel::where('user_id', $this->user_id)->first();
        $this->dados['client'] = $userClient;
        $this->dados['banks'] = $cliente->banks ?? null;
        return view('client.meus_dados', $this->dados);
    }

    public function edit()
    {
        $this->dados['client'] = UsersModel::with('client')->where('id', $this->user_id)->first();

        return view('client.edit', $this->dados);
    }

    // public function meus_dados_store(Request $request) {
    //     $request->validate([
    //         'senha' => 'required',
    //         'nova' => 'required|min:6',
    //         'nova_confima' => 'required',
    //     ]);


    //     dd(1);
    //     $senha_atual_digitada = $request->senha;
    //     $nova_senha = $request->nova;
    //     $nova_senha_confima = $request->nova_confima;
    //     if ($nova_senha != $nova_senha_confima) {
    //         return redirect('cliente/meus_dados')
    //             ->with('alert', 'Nova senha não confirmada correntamente.')
    //             ->withInput();
    //     }

    //     if (!Hash::check($senha_atual_digitada, $this->dados_cliente->cli_senha)) {
    //         return redirect('cliente/meus_dados')
    //             ->with('alert', 'Senha Atual não confere.')
    //             ->withInput();
    //     }

    //     ClientsModel::find($this->id_cliente)->update(['cli_senha' => Hash::make($nova_senha)]);
    //     return redirect('cliente')->with('alert', 'Senha atualizada');
    // }

    public function cpf()
    {
        $this->dados['client'] = $this->clientesmodel->find($this->id_cliente);
        return view('client.cpf', $this->dados);
    }

    public function cpf_store(Request $request)
    {
        $request->validate(
            ['cpf' => 'required|unique:App\Models\ClientsModel,cpf|cpfValida'],
            [
                'cpf.unique' => 'Este CPF já está cadastrado.',
                'cpf_valida' => 'CPF Inválido.',
            ]
        );
        ClientsModel::find($this->id_cliente)->update(['cpf' => $request->cpf]);
        return redirect('client/plan/select');
    }

    public function banks_store(Request $request, SaquesModel $saquesModel)
    {
        // dd($request->all());
        // $roles = [
        //     'pix' => 'required_unless:conta,null',
        //     'cpf' => 'required|cpfValida',
        //     'banco' => 'required_unless:pix,null',
        //     'agencia' => 'required_unless:pix,null',
        //     'conta' => 'required_unless:pix,null',
        // ];

        // $request->validate($roles);

        $id_cliente = ClientsModel::where('user_id', $this->user_id)->first();

        if (!isset($id_cliente)) {
            return redirect()->back()->with('alert', 'Por favor, preencha seu CPF.');
        }

        $client =  $this->clientesmodel->find($id_cliente->id);
        $banks = $client->banks;
        $banks[] = $request->all();
        $client->banks = $banks;
        $client->save();
        return redirect('client/meus_dados')->with('success', 'Banco Cadastrado');
    }

    public function files(FilesModel $filesModel)
    {
        $this->dados['files'] = $filesModel->get();
        return view('client.files', $this->dados);
    }

    public function password()
    {
        $this->dados['client'] = UsersModel::find($this->user_id);
        return view('client.password', $this->dados);
    }

    public function password_store(Request $request)
    {
        $roles = [
            'new' => ['required'],
            'new' => ['required', 'min:6'],
            'again' => ['required', 'min:6', 'same:new']
        ];

        $request->validate($roles);

        $now = $request->now;
        $new = $request->new;
        $again = $request->again;

        $user = UsersModel::find($this->user_id);
        if ($new != $again) {
            return redirect()->back()->with('alert', 'Repita corretamente a nova senha');
        }

        if (Hash::check($now, $user->password)) {
            $user->update(['password' => Hash::make($new)]);
            return redirect('client/meus_dados')->with('success', 'Senha alterada');
        } else {
            return redirect()->back()->with('alert', 'Senha Atual não confere');
        }
    }

    public function edit_store(Request $request)
    {
        $roles=[
            'name' => ['required', 'max:255'],
            'rg' => 'required',
            'phone' => ['required', 'max:20'],
            'uf' => ['required', 'max:255'],
            'city' => ['required', 'max:255'],
            'logradouro' => ['required', 'max:255'],
            'number' => ['required', 'max:255'],
            'bairro' => ['required', 'max:255'],
            'cep' => ['required', 'max:255'],
        ];

        $request->validate($roles);

        $dados = [
            'rg' => $request->rg,
            'phone' => $request->phone,
            'uf' => $request->uf,
            'city' => $request->city,
            'logradouro' => $request->logradouro,
            'number' => $request->number,
            'bairro' => $request->bairro,
            'cep' => $request->cep,
        ];

        $client = ClientsModel::where('user_id', $this->user_id)->first();

        if (!isset($client)) {
            $dados['user_id'] = $this->user_id;
            ClientsModel::create($dados);
        } else {
            $client->update($dados);
        }

        $updateUser = [
            'cell' => $request->phone,
            'name' => $request->name,

        ];

        User::where('id', $this->user_id)->update($updateUser);

        return redirect('client/meus_dados')->with('success', 'Dados Alterados');
    }

    public function pagar()
    {
        return view('client.pagar', $this->dados);
    }

    public function compras(Purchases $purchases)
    {
        $this->dados['compras'] = $purchases->where('status', 'pendente')->where('client_user_id', $this->user_id)->get();

        return view('client.compras_pendentes', $this->dados);
    }

    public function compras_confirmadas(Purchases $purchases)
    {
        $this->dados['compras'] = $purchases->where('status', 'confirmada')->where('client_user_id', $this->user_id)->get();
        $this->dados['multa_cancelamento'] = ParametersModel::first()->multa_purchease;

        return view('client.compras_confirmadas', $this->dados);
    }

    public function compras_enceradas(Purchases $purchases)
    {
        $this->dados['compras'] = $purchases->where('status', 'encerrada')->where('client_user_id', $this->user_id)->get();

        return view('client.compras_encerradas', $this->dados);
    }

    public function compras_canceladas(Purchases $purchases)
    {
        $this->dados['compras'] = $purchases->where('status', 'cancelada')->where('client_user_id', $this->user_id)->get();

        return view('client.compras_canceladas', $this->dados);
    }

    public function termos_compra()
    {
        $this->dados['param'] = ParametersModel::find(1);
        $user = UsersModel::find($this->user_id);

        $this->dados['user'] = $user;

        return view('client.termos_compra', $this->dados);
    }

    public function storetermoUser(RequestTermoUser $request)
    {
        $param = ParametersModel::find(1);

        $dados = [
            'termo_compra' => $param->termo_compra,
            'status_termo' => 'aceito',
            'dt_termo' => date('Y-m-d H:i:s'),
        ];

        UsersModel::where('id', $this->user_id)->update($dados);
        $user = UsersModel::find($this->user_id);

        $this->dados['param'] = $param;
        $this->dados['user'] = $user;
        return view('client.termos_compra', $this->dados);
    }

    public function about()
    {
        $param = ParametersModel::find(1);
        return view('client.about', compact('param'));
    }

    public function compra_info($compra_id)
    {
        $compra = ComprasModel::with('ciclo')->find($compra_id);
        return view('client.compra_info', compact('compra'));
    }

    public function depositos()
    {
        $this->dados['depositos'] = BoletosModel::where('client_id', $this->id_cliente)
            ->latest()
            ->get();
        return view('client.deposits.depositos', $this->dados);
    }

    public function depositar()
    {
        return view('client.deposits.depositar', $this->dados);
    }

    public function depositar_post(Request $request)
    {
        $valor = Utils::moeda($request->valor);
        if ($valor < 6) {
            return redirect()->back()->with('alert', 'Valor Mínimo R$ 6,00');
        }

        $insert = [
            'client_id' => $this->id_cliente,
            'tipo' => 'deposito',
            'meioPagamento' => '-',
            'valor' => Utils::moeda($request->valor),
            'created_at' => Carbon::now(),
        ];

        $deposit_id = BoletosModel::insertGetId($insert);

        return redirect('client/depositar/meio/' . Crypt::encrypt($deposit_id));
    }

    public function depositar_meio(PaymentsModel $paymentsModel, $deposit_id_crypt)
    {
        $this->dados['meios'] = $paymentsModel::where('status', 'active')->get();

        return view('client.deposits.depositar_meio', $this->dados);
    }

    public function depositar_meio_post(Request $request, PaymentsModel $paymentsModel, $deposit_id_crypt)
    {
        $deposit_id = Crypt::decrypt($deposit_id_crypt);

        $meio_id = Crypt::decrypt($request->meio);
        $meio = PaymentsModel::find($meio_id);
        $nome = $meio->slug;

        if ($nome == 'pix') {
            BoletosModel::find($deposit_id)->update(['meioPagamento' => 'PIX']);
            return redirect('client/asaas/pix/create/' . $deposit_id_crypt);
        } elseif ($nome == 'cartao') {
            BoletosModel::find($deposit_id)->update(['meioPagamento' => 'cartao_credito']);
            return redirect('client/asaas/cartao/pay/' . $deposit_id_crypt);
        } elseif ($nome == 'boleto') {
            return redirect('client/asaas/boleto/create/' . $deposit_id_crypt);
        } elseif ($nome == 'deposito') {
            return redirect('client/deposit/pay/' . $deposit_id_crypt);
        }
    }

    public function estrategia2()
    {
        return view('client/estrategia_view');
    }

    public function meu_plano()
    {
        $this->dados['boletos'] = BoletosModel::where('user_id', $this->user_id)
            ->whereDate('created_at', '>=', now()->subDays(1))
            ->latest()
            ->get();

        return view('client.compras', $this->dados);
    }

    public function plan_select()
    {
        $this->dados['pacotes'] = PlansModel::with('coin')->where('status', 'active')->get();
        $this->dados['coins'] = Coins::with('latestCotacao')->where('status', 'active')->get();

        return view('client.plan_select', $this->dados);
    }

    public function coin_select()
    {
        $this->dados['coins'] = Coins::with('latestCotacao')->where('status', 'active')->get();
        return view('client.coin_select', $this->dados);
    }

    public function plan_select_store(Request $request)
    {
        $pacote_id = Crypt::decrypt($request->pacote);

        $plan = PlansModel::find($pacote_id);
        $dataPurchase = [
            'client_user_id' => $this->user_id,
            'plan_id' => $pacote_id,
            'quantity_coin' => $plan->quantity,
            'value_coin' => $plan->coin->latestCotacao->value,
            'value_total' => $plan->value,
            'percentual_rendimento' => $plan->percentual_rendimento,
            'dt_purchase' => Carbon::now(),
            'time_pri' => $plan->time_pri,
            'status' => 'pendente',
        ];

        $storePurchese = Purchases::create($dataPurchase);

        if ($storePurchese) {
            $insert_boleto = [
                'purchase_id' => $storePurchese->id,
                'user_id' => $this->user_id,
                'tipo' => 'pagamento',
                'valor' => $plan->value,
                'quantity' => $plan->quantity,
                'created_at' => Carbon::now(),
                'status' => 'pendente',
            ];

            $boleto_id = BoletosModel::insertGetId($insert_boleto);
        }

        return redirect('client/depositar/meio/' . Crypt::encrypt($boleto_id));
    }

    public function coin_select_store(Request $request)
    {
        $roles = [
            'coin' => ['required'],
            'quantity_coin' => ['required', 'min:1'],
        ];

        $request->validate($roles);
        $coin_id = Crypt::decrypt($request->coin);

        $coin = Coins::find($coin_id);

        $value_total = $coin->latestCotacao->value * $request->quantity_coin;

        $dataPurchase = [
            'client_user_id' => $this->user_id,
            'coin_id' => $coin_id,
            'quantity_coin' => $request->quantity_coin,
            'value_coin' => $coin->latestCotacao->value,
            'value_total' => $value_total,
            'percentual_rendimento' => $coin->profit_percentage,
            'dt_purchase' => Carbon::now(),
            'time_pri' => $coin->time_pri,
            'status' => 'pendente',
        ];

        $storePurchese = Purchases::create($dataPurchase);

        if ($storePurchese) {
            $insert_boleto = [
                'purchase_id' => $storePurchese->id,
                'user_id' => $this->user_id,
                'tipo' => 'pagamento',
                'valor' => $storePurchese->value_total,
                'quantity' => $storePurchese->quantity_coin,
                'created_at' => Carbon::now(),
                'status' => 'pendente',
            ];

            $boleto_id = BoletosModel::insertGetId($insert_boleto);
        } else {
            return redirect()->back()->with('erro', 'Erro ao realizar a compra!');
        }

        return redirect('client/depositar/meio/' . Crypt::encrypt($boleto_id));
    }

    public function tutorial()
    {
        return view('client.tutorial');
    }

    public function saquesRendimentos(SaquesModel $saquesModel)
    {
        // $this->dados['saques'] = SaquesModel::
        // $rendimentos_pagos = RendimentosPagos::join('boletos', 'rendimentos_pagos.boleto_id', 'boletos.id')
        //     ->where('boletos.user_id', $this->user_id)
        //     ->where('boletos.status', 'encerrado')
        //     ->select('rendimentos_pagos.*')
        //     ->get();


        $this->dados['saques'] = $saquesModel
            ->where('moeda', 'rendimento')
            ->where('user_id', $this->user_id)->get();

        // $this->dados['rendimentos_pagos'] = $rendimentos_pagos;

        return view('client.saques_rendimentos', $this->dados);
    }

    // public function saque_rendimento_store(Request $request)
    // {
    //     $balances = new Balance();
    //     $balance = $balances->balance($this->id_cliente, 'rendimento');
    //     dd($balance);
    //     if ($request->conta == '') {
    //         return redirect()->back()->with('alert', 'Informe a conta para saque');
    //     }

    //     $value = Utils::moeda($request->valor);
    //     if ($value <= 0 || $value > $balance) {
    //         return redirect()->back()->with('alert', 'Saldo Insuficiente');
    //     }

    //     $data = [
    //         'cliente_id' => $this->id_cliente,
    //         'valor' => $value,
    //         'moeda' => 'rendimento',
    //         'banco' => $request->conta,
    //     ];
    //     SaquesModel::create($data);
    //     return redirect('client/saques/rendimento')->with('alert', 'Saque Solicitado');
    // }

    public function saquesInvestimentos(SaquesModel $saquesModel)
    {
        $investimento = BalancesModel::where('coin', 'investimento')
        ->where('user_id', $this->user_id)
        ->latest()->first();

        $this->dados['saquesInvestimento'] = $saquesModel
        ->where('moeda', 'investimento_encerrado')
        ->where('user_id', $this->user_id)->get();

        $this->dados['investimento'] = $investimento;

        return view('client.saque_investimentos', $this->dados);
    }

    public function saque_rendimento()
    {
        $quinta_feira = date('w');
        $id_cliente =  ClientsModel::where('user_id', $this->user_id)->first()->id;

        if ($quinta_feira != 5) {
            // return redirect()->back()->with('alert', 'Saque liberado todas as quinta-feiras');
        }

        $this->dados['bancos'] = ClientsModel::getBancosList($id_cliente);

        $balances = new Balance();
        $this->dados['balances'] = $balances->balances($this->user_id, 'rendimento');
        $saldo_disponivel = $this->dados['balances']['saldo_disponivel'];
        $this->dados['totalDiponivelSaque'] = $saldo_disponivel;

        return view('client.saques.saque_rendimento', $this->dados);
    }

    public function saque_rendimento_store(Request $request)
    {
        $roles = [
            'valor' => 'required',
            'conta' => 'required',
        ];


        $request->validate($roles);

        $balances = new Balance();
        $valorSolicitado = floatval(Utils::moeda($request->valor));

        $this->dados['balances'] = $balances->balances($this->user_id, 'rendimento');
        $saldo_disponivel = $this->dados['balances']['saldo_disponivel'];
        // $saldo_disponivel -= $this->dados['balances']['saque_pendente'];


        if ($valorSolicitado > $saldo_disponivel) {
            return redirect()->back()->with('alert', 'Valor Solicitado maior que o disponível');
        }


        if ($request->conta == '') {
            return redirect()->back()->with('alert', 'Informe a conta para saque');
        }

        if ($valorSolicitado <= 0 || $valorSolicitado > $saldo_disponivel) {
            return redirect()->back()->with('alert', 'Saldo Insuficiente');
        }

        $data = [
            'user_id' => $this->user_id,
            'valor' => $valorSolicitado,
            'moeda' => 'rendimento',
            'banco' => $request->conta,
        ];

        SaquesModel::create($data);

        return redirect()->route('solicitar.saques.rendimentos')->with('success', 'Saque Solicitado');
    }

    public function saque_investimento()
    {
        $balances = new Balance();

        $quinta_feira = date('w');
        $id_cliente =  ClientsModel::where('user_id', $this->user_id)->first()->id;
        $totalRendimento = 0;

        if ($quinta_feira != 5) {
            // return redirect()->back()->with('alert', 'Saque liberado todas as quinta-feiras');
        }

        $this->dados['bancos'] = ClientsModel::getBancosList($id_cliente);
        $this->dados['balances'] = $balances->balances($this->user_id, 'investimento_encerrado');

        $investimentoDisponivel = $this->dados['balances']['saldo_disponivel'];
        $this->dados['totalDiponivelSaque'] = $investimentoDisponivel;

        return view('client.saques.saque_investimento', $this->dados);
    }

    public function saque_investimento_store(Request $request)
    {
        $roles = [
            'valor' => 'required',
            'conta' => 'required',
        ];

        $request->validate($roles);

        $id_client = ClientsModel::where('user_id', $this->user_id)->first()->id;
        $valorSolicitado = floatval(Utils::moeda($request->valor));

        $balances = new Balance();
        $this->dados['balances'] = $balances->balances($this->user_id, 'investimento_encerrado');
        $investimentoDisponivel = $this->dados['balances']['saldo_disponivel'];

        // dd($valorSolicitado, $investimentoDisponivel);

        $investimentoDisponivel = Utils::moeda($investimentoDisponivel);

        if ($valorSolicitado > $investimentoDisponivel) {
            return redirect()->back()->with('alert', 'Valor Solicitado maior que o disponível');
        }

        if ($valorSolicitado <= 0 || $valorSolicitado > $investimentoDisponivel) {
            return redirect()->back()->with('alert', 'Saldo Insuficiente');
        }

        if ($request->conta == '') {
            return redirect()->back()->with('alert', 'Informe a conta para saque');
        }

        $data = [
            'user_id' => $this->user_id,
            'valor' => $valorSolicitado,
            'moeda' => 'investimento_encerrado',
            'banco' => $request->conta,
        ];

        SaquesModel::create($data);

        return redirect()->route('saques.investimentos')->with('success', 'Saque solicitado com sucesso!');
    }

    public function show_investimento(Purchases $purchases)
    {
        $boleto = BoletosModel::where('purchase_id', $purchases->id)->first();
        $this->dados['purchases'] = $purchases;
        $this->dados['boleto'] = $boleto;

        return view('client.compras.show_compra', $this->dados);
    }


    // Requisição Ajax
    public function ajax_cotacoes_coin(Request $request)
    {
        $cotacoes = [];
        $year = date('Y');
        $monthStart = date('m', strtotime('2022-01-01'));
        $monthEnd = date('m', strtotime('2022-12-31'));

        $coin = Coins::where('id', $request->id_coin_selected)->where('status', 'active')->first();

        $cotacoes_moeda = CotacaoMoeda::where('id_coin', $coin->id)->orderBy('created_at', 'ASC')->latest()->limit(12)->get();

        $cotacoes['moeda'] = $coin->name;


        foreach ($cotacoes_moeda as $key => $cotacao) {
            $cotacoes['valores'][$key] = $cotacao->value;
            $cotacoes['datas'][$key] = date('d-m-Y', strtotime($cotacao->created_at));
        }

        return response()->json($cotacoes);
    }

    public function cancelar_compra(Purchases $purchase, Balance $balance)
    {
        // Data cancelamento
        $data_atual = date('Y-m-d');
        $multa = ParametersModel::first()->multa_purchease;
        $boleto_compra  = BoletosModel::where('purchase_id', $purchase->id)->first();
        $data_compra = date('Y-m-d', strtotime($boleto_compra->dataConfirmacao));

        // Calcular o tempo de investimento
        $timeInvestment = Carbon::parse($data_compra)->DiffInMonths($data_atual);

        // Rendimentos do investimento
        $rendimentos_pagos = RendimentosPagos::join('boletos', 'rendimentos_pagos.boleto_id', 'boletos.id')
                ->where('rendimentos_pagos.boleto_id', $boleto_compra->id)
                ->sum('rendimentos_pagos.valor');

        $valor_invest_lucro = $boleto_compra->valor + $rendimentos_pagos;

        // Verificar se o tempo do investimento é menor que o tempo previsto
        if ($timeInvestment < $purchase->time_pri) {
            // $valor_multa = $valor_invest_lucro * $multa / 100;
            $valor_multa = round(($valor_invest_lucro * $multa) / 100, 2);
            $valor_total = $valor_invest_lucro - $valor_multa;

            $balance->credit($purchase->client_user_id, $boleto_compra->valor, 'investimento_encerrado', 'compra_cancelada');
            $balance->debit($purchase->client_user_id, $boleto_compra->valor, 'investimento', 'compra_cancelada');

            $balance->debit($purchase->client_user_id, $valor_multa, 'investimento_encerrado', 'multa_cancelamento');

            $data_purchase = [
                'status' => 'cancelada',
                'valor_multa' => $valor_multa,
                'valor_recebido' => $valor_total,
                'dt_encerramento' => $data_atual,
            ];

            $data_boleto = [
                'status' => 'cancelado',
                'dt_encerramento' => $data_atual,
            ];

            $purchase->update($data_purchase);
            $boleto_compra->update($data_boleto);

            return redirect()->back()->with('success', 'Compra cancelada com sucesso!');
        } else {
            return redirect()->back()->with('alert', 'Compra já foi encerrada!');
        }
    }
}
