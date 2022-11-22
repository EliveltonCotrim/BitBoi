<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\RequestCreateCoins;
use App\Http\Requests\Admin\RequestEditCoins;
use App\Models\Coins;
use App\Models\CotacaoMoeda;
use App\Src\Utils\Utils;
use Illuminate\Http\Request;

class CoinsController extends Controller
{
    private $dados;
    private $coins;

    public function __construct(Coins $coins)
    {
        $this->coins = $coins;
    }

    public function index(Request $request)
    {
        $this->dados['filters'] =  $request->all();

        // $this->dados['coins'] = Coins::with('latestCotacao')->get();

        if ($request->search) {
            $this->dados['coins'] = Coins::with('latestCotacao')
            ->where('name', 'LIKE', '%' . $request->name .'%')
            ->orderBy('name', 'asc')
            ->get();
        } else {
            $this->dados['coins'] = Coins::with('latestCotacao')->orderBy('name', 'asc')->get();
        }


        return view('admin.coins.coins_list', $this->dados);
    }
    public function create()
    {
        return view('admin.coins.coins_create');
    }


    public function store(RequestCreateCoins $request)
    {
        $dataCoin = [
            'name' => $request->name,
            'profit_percentage' => Utils::moeda($request->profit_percentage),
            'status' => 'active',
            'time_pri' => $request->time_pri,
        ];

        // dd($dataCoin);
        $coin = Coins::create($dataCoin);

        if ($coin) {
            $dataCotacaoCoin = [
                'id_coin' => $coin->id,
                'value' => Utils::moeda($request->value),
                'status' => 'active',
            ];

            CotacaoMoeda::create($dataCotacaoCoin);

            return redirect()->route('coins.index')->with('success', 'Moeda cadastrada com sucesso!');
        } else {
            return redirect()->back()->with('erro', 'Erro ao cadastrar moeda');
        }
    }

    public function edit(Coins $coin)
    {
        return view('admin.coins.coin_edit', compact('coin'));
    }


    public function update(RequestEditCoins $request, Coins $coins)
    {
        $dataCoin = [
            'name' => $request->name,
            'profit_percentage' => Utils::moeda($request->profit_percentage),
            'time_pri' => $request->time_pri,
            'status' => $request->status,
        ];

        $coin = Coins::where('id', $coins->id)->update($dataCoin);

        if ($coin) {
            if ($request->nova_cotacao) {
                $cotacaoAtual = CotacaoMoeda::where('id_coin', $coins->id)->where('status', 'active')->latest()->first();
                $cotacaoAtual->update(['status' => 'inactive']);

                $dataCotacaoCoin = [
                    'id_coin' => $coins->id,
                    'value' => Utils::moeda($request->nova_cotacao),
                    'status' => 'active',
                ];

                CotacaoMoeda::create($dataCotacaoCoin);
            }

            return redirect()->route('coins.index')->with('success', 'Moeda atualizada com sucesso!');
        } else {
            return redirect()->back()->with('erro', 'Erro ao atualizar moeda!');
        }
    }

    public function delete(Coins $coins)
    {
    }
}
