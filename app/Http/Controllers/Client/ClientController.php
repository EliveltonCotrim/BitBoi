<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\BoletosModel;
use App\Models\ClientsModel;
use App\Models\Coins;
use App\Models\ComprasModel;
use App\Models\FaqsModel;
use App\Models\FilesModel;
use App\Models\ParametersModel;
use App\Models\PaymentsModel;
use App\Models\PlansModel;
use App\Models\SaquesModel;
use App\Models\UsersModel;
use App\Src\Plans\PlanClient;
use App\Src\Rede\Unilevel;
use App\Src\Utils\Utils;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller {

    private $dados = [];
    private $user_id;

    function __construct() {
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

    public function index(BoletosModel $boletos) {
        $saldo_tokens = $boletos
            ->where('user_id', $this->user_id)
            ->where('status', 'confirmado')
            ->sum('quantity');

        // dd($saldo_tokens);


        return view('client.home_client', compact('saldo_tokens'));
    }

    public function faq() {
        $faqs = FaqsModel::get();
        return view('client.faq', compact('faqs'));
    }

    public function logout(Request $request) {
        $request->session()->flush();
        return redirect('/');
    }

    public function minha_rede() {
        $unilevel = new Unilevel();
        $this->dados['rede'] = $unilevel->getAll($this->id_cliente);
        return view('client.minha_rede', $this->dados);
    }

    public function diretos() {
        $unilevel = new Unilevel();
        $this->dados['rede'] = $unilevel->diretos($this->id_cliente);
        return view('client.diretos', $this->dados);
    }

    public function meus_dados() {
        $client = UsersModel::find($this->user_id);
        $this->dados['client'] = $client;
        $this->dados['banks'] = $client->banks;
        return view('client.meus_dados', $this->dados);
    }

    public function edit() {
        $this->dados['client'] = UsersModel::find($this->user_id);
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

    public function cpf() {
        $this->dados['client'] = $this->clientesmodel->find($this->id_cliente);
        return view('client.cpf', $this->dados);
    }

    public function cpf_store(Request $request) {
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

    public function banks_store(Request $request, SaquesModel $saquesModel) {
        $client =  $this->clientesmodel->find($this->id_cliente);
        $banks = $client->banks;
        $banks[] = $request->all();
        $client->banks = $banks;
        $client->save();
        return redirect('client/meus_dados')->with('alert', 'Banco Cadastrado');
    }

    public function files(FilesModel $filesModel) {
        $this->dados['files'] = $filesModel->get();
        return view('client.files', $this->dados);
    }

    public function password() {
        $this->dados['client'] = UsersModel::find($this->user_id);
        return view('client.password', $this->dados);
    }

    public function password_store(Request $request) {
        $request->validate(
            ['new' => 'required|min:6'],
            ['new.min' => 'Mínimo de 6 caracteres']
        );

        $now = $request->now;
        $new = $request->new;
        $again = $request->again;

        $user = UsersModel::find($this->user_id);
        if ($new != $again) {
            return redirect()->back()->with('alert', 'Repita corretamente a nova senha');
        }

        if (Hash::check($now, $user->password)) {
            $user->update(['password' => Hash::make($new)]);
            return redirect('client/meus_dados')->with('alert', 'Senha alterada');
        } else {
            return redirect()->back()->with('alert', 'Senha Atual não confere');
        }
    }

    public function edit_store(Request $request) {
        $client = UsersModel::find($this->user_id);

        $update = [
            'name' => $request->name,
            'cell' => $request->phone,
        ];
        $client->update($update);
        return redirect('client/meus_dados')->with('alert', 'Dados Alterados');
    }

    public function pagar() {
        return view('client.pagar', $this->dados);
    }

    public function compras() {
        // $this->dados['compras_ciclos'] = $compras->comprasByCiclo($this->id_cliente);
        // $this->dados['compras'] = $compras->comprasList($this->id_cliente);

        return view('client.compras', $this->dados);
    }

    public function termos_compra() {
        $this->dados['param'] = ParametersModel::find(1);
        return view('client.termos_compra', $this->dados);
    }

    public function about() {
        $param = ParametersModel::find(1);
        return view('client.about', compact('param'));
    }

    public function compra_info($compra_id) {
        $compra = ComprasModel::with('ciclo')->find($compra_id);
        return view('client.compra_info', compact('compra'));
    }

    public function depositos() {
        $this->dados['depositos'] = BoletosModel::where('client_id', $this->id_cliente)
            ->latest()
            ->get();
        return view('client.deposits.depositos', $this->dados);
    }

    public function depositar() {
        return view('client.deposits.depositar', $this->dados);
    }

    public function depositar_post(Request $request) {
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

    public function depositar_meio(PaymentsModel $paymentsModel, $deposit_id_crypt) {
        $this->dados['meios'] = $paymentsModel::where('status', 'active')->get();
        return view('client.deposits.depositar_meio', $this->dados);
    }

    public function depositar_meio_post(Request $request, PaymentsModel $paymentsModel, $deposit_id_crypt) {
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

    public function estrategia2() {
        return view('client/estrategia_view');
    }

    public function meu_plano() {
        $this->dados['boletos'] = BoletosModel::where('user_id', $this->user_id)
            ->whereDate('created_at', '>=', now()->subDays(1))
            ->latest()
            ->get();

        return view('client.meu_plano', $this->dados);
    }

    public function plan_select() {
        $this->dados['pacotes'] = PlansModel::where('status', 'active')->get();
        return view('client.plan_select', $this->dados);
    }

    public function coin_select() {

        $this->dados['coins'] = Coins::with('latestCotacao')->where('status', 'active')->get();
        return view('client.coin_select', $this->dados);
    }

    public function plan_select_store(Request $request) {
        $pacote_id = Crypt::decrypt($request->pacote);
        $plan = PlansModel::find($pacote_id);

        $insert_boleto = [
            'user_id' => $this->user_id,
            'plan_id' => $plan->id,
            'tipo' => 'pagamento',
            'status' => 'pendente',
            'valor' => $plan->value,
            'plan_id' => $pacote_id,
            'quantity' => $plan->quantity,
            'created_at' => now(),
        ];
        $boleto_id = BoletosModel::insertGetId($insert_boleto);
        return redirect('client/depositar/meio/' . Crypt::encrypt($boleto_id));
    }

    public function tutorial() {
        return view('client.tutorial');
    }
}
