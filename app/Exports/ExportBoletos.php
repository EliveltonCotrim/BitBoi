<?php

namespace App\Exports;

use App\Models\BoletosModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportBoletos implements FromCollection, ShouldAutoSize, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return BoletosModel::join('purchases', 'boletos.purchase_id', '=', 'purchases.id')
        ->join('users', 'purchases.client_user_id', '=', 'users.id')
        ->select('users.name', 'users.cpf', 'boletos.valor', 'boletos.meioPagamento', 'boletos.dataConfirmacao')
        ->where('boletos.status', 'confirmado')->get();

    }

    public function headings(): array
    {
        return [
            'CLIENTE', 'CPF_CLIENTE', 'VALOR_COMPRA', 'MEIO_DE_PAGAMENTO', 'DATA_CONFIRMACAO'
        ];
    }
}
