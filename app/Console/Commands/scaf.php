<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class scaf extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:scaf';

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

        $tables = DB::select('SHOW TABLES');
        $tables = array_map('current', $tables);
        foreach ($tables as $k => $table) {
            $this->info($k . ' - ' . $table);
        }

        $numero_tabela = $this->ask('Informe o nº da Tabela: ');
        $nome_tabela = $tables[$numero_tabela];
        if (!$nome_tabela || !in_array($nome_tabela, $tables)) {
            $this->info("Tabela '{$nome_tabela}' Não Encontrada");
            return;
        }

        $campos = DB::getSchemaBuilder()->getColumnListing($nome_tabela);
        $campo1 = $campos[0];
        $campo2 = $campos[1];

        // $this->info("================");
        // dump($campos);
        // $this->info("================");

        $nome_tabela_uc = ucfirst($nome_tabela);
        $nome_controller = ucfirst($nome_tabela) . 'Controller.php';
        $nome_model = ucfirst($nome_tabela) . 'Model.php';

        /*
        $exists = Storage::disk('controler')->exists('Admin/' . $nome_controller);
        if ($exists) {
            $this->info("'{$nome_controller}' Já Existe.");
            $continua = $this->ask('Continua? [s,n]: ');
            if ($continua != 's') {
                $this->info("Interrompido");
                return;
            }
        }
        */

        $controller_content = $this->controller_content($nome_tabela, $campo1, $campo2);
        $model_content = $this->model_content($nome_tabela, $campo1, $campo2, $campos);

        /*
        Storage::disk('view')->put("/dashboard/{$nome_tabela}/{$nome_tabela}_list.blade.php", $this->view_list_content($nome_tabela, $campos, $campo1, $campo2));
        Storage::disk('view')->put("/dashboard/{$nome_tabela}/{$nome_tabela}_create.blade.php", $this->view_create_content($nome_tabela, $campos, $campo1, $campo2));
        Storage::disk('view')->put("/dashboard/{$nome_tabela}/{$nome_tabela}_edit.blade.php", $this->view_edit_content($nome_tabela, $campos, $campo1, $campo2));
        Storage::disk('view')->put("/dashboard/{$nome_tabela}/{$nome_tabela}_delete.blade.php", $this->view_delete_content($nome_tabela, $campos, $campo1, $campo2));
        Storage::disk('view')->put("/dashboard/{$nome_tabela}/{$nome_tabela}_show.blade.php", $this->view_show_content($nome_tabela, $campos, $campo1, $campo2));
        Storage::disk('view')->put("/dashboard/{$nome_tabela}/_partials/{$nome_tabela}_form.blade.php", $this->view_form_content($nome_tabela, $campos, $campo1, $campo2));
        */

        $path_storage = "scaf/{$nome_tabela}/";
        $path_request = app_path() . "/Http/Requests/";
        $path_views = resource_path() . "/views/admin/{$nome_tabela}/";

        $list_file = $path_storage . "views/{$nome_tabela}_list.blade.php";
        $create_file = $path_storage . "views/{$nome_tabela}_create.blade.php";
        $edit_file = $path_storage . "views/{$nome_tabela}_edit.blade.php";
        $delete_file = $path_storage . "views/{$nome_tabela}_delete.blade.php";
        $show_file = $path_storage . "views/{$nome_tabela}_show.blade.php";
        $form_file = $path_storage . "views/_partials/{$nome_tabela}_form.blade.php";

        $controller_file = $path_storage . $nome_controller;
        $model_file = $path_storage . $nome_model;
        $request_file = $path_storage . "StoreUpdate{$nome_tabela_uc}.php";

        if (!file_exists($path_views)) {
            mkdir($path_views, 0777, true);
        }

        if (!file_exists($path_views . '/_partials/')) {
            mkdir($path_views . '/_partials/', 0777, true);
        }

        if (!file_exists($path_request)) {
            mkdir($path_request, 0777, true);
        }

        Storage::put($controller_file, $controller_content);
        Storage::put($model_file, $model_content);
        Storage::put($request_file, $this->request_content($nome_tabela_uc, $campo2));

        copy(storage_path() . '/app/' . $controller_file, app_path() . "/Http/Controllers/Admin/{$nome_controller}");
        copy(storage_path() . '/app/' . $model_file, app_path() . "/Models/{$nome_model}");
        copy(storage_path() . '/app/' . $request_file, $path_request . "StoreUpdate{$nome_tabela_uc}.php");

        Storage::put($list_file, $this->view_list_content($nome_tabela, $campos, $campo1, $campo2));
        Storage::put($create_file, $this->view_create_content($nome_tabela, $campos, $campo1, $campo2));
        Storage::put($edit_file, $this->view_edit_content($nome_tabela, $campos, $campo1, $campo2));
        Storage::put($delete_file, $this->view_delete_content($nome_tabela, $campos, $campo1, $campo2));
        Storage::put($show_file, $this->view_show_content($nome_tabela, $campos, $campo1, $campo2));
        Storage::put($form_file, $this->view_form_content($nome_tabela, $campos, $campo1, $campo2));

        copy(storage_path() . '/app/' . $list_file, $path_views . "{$nome_tabela}_list.blade.php");
        copy(storage_path() . '/app/' . $create_file, $path_views . "{$nome_tabela}_create.blade.php");
        copy(storage_path() . '/app/' . $edit_file, $path_views . "{$nome_tabela}_edit.blade.php");
        copy(storage_path() . '/app/' . $delete_file, $path_views . "{$nome_tabela}_delete.blade.php");
        copy(storage_path() . '/app/' . $show_file, $path_views . "{$nome_tabela}_show.blade.php");
        copy(storage_path() . '/app/' . $form_file, $path_views . "_partials/{$nome_tabela}_form.blade.php");

        Storage::deleteDirectory($path_storage);

        $pos = strpos($nome_controller, '.');
        $nome_rota = substr($nome_controller, 0, $pos);
        $this->info("=======================================");
        $this->info("use App\Http\Controllers\Dashboard\\" . $nome_rota . ";");

        // $this->info("Route::match(['post', 'get'], '{$nome_tabela}', [{$nome_rota}::class, 'index']);");
        // $this->info("Route::match(['post', 'get'], '{$nome_tabela}/create', [{$nome_rota}::class, 'create']);");
        // $this->info("Route::match(['post', 'get'], '{$nome_tabela}/edit/{id}', [{$nome_rota}::class, 'edit']);");
        // $this->info("Route::match(['post', 'get'], '{$nome_tabela}/delete/{id}', [{$nome_rota}::class, 'delete']);");

        $this->info("Route::resource('{$nome_tabela}', {$nome_rota}::class);");
        // $this->info("Route::post('{$nome_tabela}/search', [{$nome_rota}::class, 'search'])->name('{$nome_tabela}.search');");

        $this->info("=======================================");

        return 0;
    }


    private function request_content($nome_tabela, $campo2) {
        return ""
            . "<?php
    namespace App\Http\Requests;
    
    use Illuminate\Foundation\Http\FormRequest;
    
    class StoreUpdate{$nome_tabela} extends FormRequest{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                '{$campo2}' => ['required'],
        ];
    }
}
"
            . "";
    }
    private function model_content($nome_tabela, $campo1, $campo2, $campos) {

        $nome_tabela_uc = ucfirst($nome_tabela);

        $campos_str = '';
        foreach ($campos as $k => $campo) {
            if ($k == 0 ||  in_array($campo, ['id', 'created_at', 'updated_at'])) {
                continue;
            }

            $campos_str .= " '{$campo}',";
        }

        return "" .
            "<?php\n" .
            "\n" .
            "namespace App\Models;\n" .
            "\n" .
            "use Illuminate\Database\Eloquent\Factories\HasFactory;\n" .
            "use Illuminate\Database\Eloquent\Model;\n" .
            "class {$nome_tabela_uc}Model extends Model {" .
            "" .
            "  use HasFactory;" .
            "" .
            "" .
            "

    protected \$table = '{$nome_tabela}';
    protected \$primaryKey = 'id';
    // const CREATED_AT = 'creation_date';
    // const UPDATED_AT = 'last_update';

    protected \$fillable =[{$campos_str}];
    protected \$date =['created_at','updated_at'];

    public function scopeGetAll(\$query, \$post) {
        if (\$post->input('{$campo2}') != '') {
            \$query->where('{$campo2}', 'LIKE', '%' . \$post->input('{$campo2}') . '%');
        }

        \$dados =  \$query
            ->orderBy('{$campo2}')
            ->paginate(10);
        return \$dados;
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Builder  \$query
     * @return []
     */
    public function scopeGetArray(\$query) {
        \$dados =  \$query->get();

       \$result = [];
       \$result[''] = 'Selecione!';
        foreach (\$dados as \$dado) {
            \$result[\$dado->{$campo1}] = \$dado->{$campo2};
        }

        return \$result;
    }
}
" .
            "";
    }

    private function controller_content($nome_tabela, $campo1, $campo2) {

        $nome_tabela_uc = ucfirst($nome_tabela);

        return "" .
            "<?php " .
            "\n" .
            "\n" .
            "namespace App\Http\Controllers\Admin;\n" .
            "\n" .
            "use App\Http\Requests\StoreUpdate{$nome_tabela_uc};" .
            "\n" .
            "use App\Http\Controllers\Controller;" .
            "\n" .
            "use App\Models\\{$nome_tabela_uc}Model;\n" .
            "use Illuminate\Http\Request;\n" .
            "use Illuminate\Support\Facades\App;\n" .
            "\n" .
            "class {$nome_tabela_uc}Controller extends Controller {\n" .
            "" .
            "
    private \$dados;
    private \${$nome_tabela};

    public function __construct({$nome_tabela_uc}Model \${$nome_tabela}) {
        \$this->{$nome_tabela} = \${$nome_tabela};
    }
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request \$request) {
        \$filters = \$request->except('_token');
        \$this->dados['filters'] =\$filters;

        \${$nome_tabela} = \$this->{$nome_tabela}
                            ->where(function(\$query) use (\$request) {
                                if (\$request->{$campo2}) {
                                    \$query->where('{$campo2}', \$request->{$campo2});
                                }
                            })
                            ->latest()
                            ->paginate();

        \$this->dados['{$nome_tabela}'] = \${$nome_tabela};
        return view('admin.{$nome_tabela}.{$nome_tabela}_list', \$this->dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
         \$this->dados['titulo'] = '{$nome_tabela}';
         return view('admin.{$nome_tabela}.{$nome_tabela}_create', \$this->dados);
    }
    
    public function store(StoreUpdate{$nome_tabela_uc} \$request) {
            \$this->{$nome_tabela}->create(\$request->all());
            return redirect('admin/{$nome_tabela}');
    }

  public function show(\$id)
    {
        if (!\${$nome_tabela} = \$this->{$nome_tabela}->find(\$id)) {
            return redirect()->back();
        }

       \$this->dados['titulo'] = '{$nome_tabela}';
       \$this->dados['{$nome_tabela}'] = \${$nome_tabela};
        return view('admin.{$nome_tabela}.{$nome_tabela}_show', \$this->dados);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\{$nome_tabela}Model  \${$nome_tabela}
     * @return \Illuminate\Http\Response
     */
    public function edit(Request \$request, \$id) {
            \${$nome_tabela} = \$this->{$nome_tabela}->find(\$id);
            \$this->dados['{$nome_tabela}'] = \${$nome_tabela};
            \$this->dados['titulo'] = '{$nome_tabela}';
            return view('admin.{$nome_tabela}.{$nome_tabela}_edit', \$this->dados);
    }
    
    public function update(StoreUpdate{$nome_tabela_uc} \$request, \$id) {
            \$this->{$nome_tabela}->find(\$id)->update(\$request->all());
            return redirect('admin/{$nome_tabela}');
    }

    public function delete(Request \$request, \$id) {
        if (\$request->isMethod('post')) {
            \$input = \$request->except(['_token']);
            {$nome_tabela}Model::where('{$campo1}', \$id)->delete();
            return redirect('/admin/{$nome_tabela}');
        } else {
            \${$nome_tabela} = {$nome_tabela}Model::where('{$campo1}', \$id)->first();
            \$this->dados['{$nome_tabela}'] = \${$nome_tabela};
            \$this->dados['titulo'] = '{$nome_tabela}';
            return view('admin/{$nome_tabela}.{$nome_tabela}_delete', \$this->dados);
        }
    }

  
    " .
            "}";
    }

    private function view_delete_content($nome_tabela, $campos, $campo1, $campo2) {

        return "" .
            "" .
            "@extends('admin.index_admin')\n" .
            "@section('title', \$titulo)\n"  .
            "@section('content')\n" .
            "<div class='row'>\n" .
            "   <div class='col-md-6'>\n" .
            "\n" .
            "       <h2><?php echo  ucfirst(\$titulo) ?></h2>\n" .
            "   </div>" .
            "<div class='col-md-6 text-right'>\n" .
            "   <a href='<?php echo url('/admin/{$nome_tabela}'); ?>' class='btn btn-primary'>\n" .
            "      Voltar\n" .
            "  </a>" .
            "</div>" .
            "</div>" .
            "" .
            "


<div class='form-horizontal'>

    <form action='' method='post'>

        @csrf
        <div class='form-row'>
            <input type='hidden' name='delete' value='<?php echo \${$nome_tabela}->{$campo1} ?>' class='form-control' required='true'>
        </div>
        <div class='form-row'>
            <div class='col-md-4'>
                <h4>Confirma a Exclusão</h4>
                <label>&nbsp;</label>
                <button type='submit' class='btn btn-primary form-control'>
                    Deletar
                </button>
                <br>
                <br>
                <a href='{{ url('{$nome_tabela}') }}'>
                    Voltar
                </a>
            </div>
        </div>
    </form>

</div>

" .
            "@endsection\n" .
            "";
    }

    private function view_show_content($nome_tabela, $campos, $campo1, $campo2) {

        $inputs = "";
        foreach ($campos as $k => $campo) {
            if ($k == 0 ||  in_array($campo, ['id', 'created_at', 'updated_at', 'uuid'])) {
                continue;
            }

            $nome_campo = ucfirst($campo);

            $inputs .= "" .
                "<div class='col-md-4'>\n" .
                "   <label >{$nome_campo}</label>\n" .
                "   <input type='text' readonly value='{{ \${$nome_tabela}->{$campo} }}' class='form-control'>\n" .
                "</div>\n";
        }

        return "" .
            "@extends('admin.index_admin')\n" .
            "@section('title', '{$nome_tabela}')\n" .
            "\n" .
            "@section('actions')\n" .
            "   <a href='<?php echo url('/admin/{$nome_tabela}'); ?>' class='btn btn-primary'>\n" .
            "      Voltar\n" .
            "  </a>" .
            "@endsection\n" .
            "\n" .
            "@section('content')\n" .
            "\n" .
            "<div class='card'>\n" .
            "<div class='card-body'>\n" .
            "\n"

            . "

        <div class='form-row'>
            {$inputs}
        </div>
        <div class='form-row'>
            <div class='col-md-2'>
                <label >Excluir?</label>
                <button type='submit' class='btn btn-primary form-control'>
                    Excluir
                </button>
            </div>
        </div>
        
               </div>
    </div>
</div>
</div>
</div>
@endsection
        "
            . "";
    }

    private function view_form_content($nome_tabela, $campos, $campo1, $campo2) {

        $inputs = "";
        foreach ($campos as $k => $campo) {
            if ($k == 0 ||  in_array($campo, ['id', 'created_at', 'updated_at', 'uuid'])) {
                continue;
            }

            $nome_campo = ucfirst($campo);

            $inputs .= "" .
                "<div class='col-md-4'>\n" .
                "   <label >{$nome_campo}</label>\n" .
                "   <input type='text' name='{$campo}' value='{{ \${$nome_tabela}->{$campo} ?? old(\"{$campo}\")  }}' class='form-control'>\n" .
                "</div>\n";
        }

        return ""

            . "

        <div class='form-row'>
            {$inputs}
        </div>
        <div class='form-row'>
            <div class='col-md-2'>
                <label >&nbsp;</label>
                <button type='submit' class='btn btn-primary form-control'>
                    Salvar
                </button>
            </div>
        </div>"
            . "";
    }

    private function view_edit_content($nome_tabela, $campos, $campo1, $campo2) {
        $nome_tabela_uc = ucfirst($nome_tabela);

        return "" .
            "@extends('admin.index_admin')\n" .
            "@section('title', '{$nome_tabela_uc}')\n" .
            "\n" .
            "@section('actions')\n" .
            "   <a href='<?php echo url('/admin/{$nome_tabela}'); ?>' class='btn btn-primary'>\n" .
            "      Voltar\n" .
            "  </a>" .
            "@endsection\n" .
            "\n" .
            "@section('content')\n" .
            "\n" .
            "<div class='card'>\n" .
            "<div class='card-body'>\n" .
            "\n" .
            "
   
    <div class='col-md-12'>
        <div class='form-horizontal'>
        @include('commons/alerts')
        <form action=\"{{ route('{$nome_tabela}.update',\${$nome_tabela}->id) }}\" method='post'>
            @csrf
            @method('PUT')

            @include('admin.{$nome_tabela}._partials.{$nome_tabela}_form')
        </form>

        </div>
    </div>
</div>
</div>
</div>
@endsection

" .
            "";
    }

    private function view_create_content($nome_tabela, $campos, $campo1, $campo2) {

        $nome_tabela_uc = ucfirst($nome_tabela);

        $inputs = "";
        foreach ($campos as $k => $campo) {
            if ($k == 0 ||  in_array($campo, ['id', 'created_at', 'updated_at', 'uuid'])) {
                continue;
            }
            $nome_campo = ucfirst(($campo));
            $inputs .= "" .
                "<div class='col-md-4'>\n" .
                "   <label >{$nome_campo}</label>\n" .
                "   <input type='text' name='{$campo}' value='<?php echo isset(\${$nome_tabela}) ? \${$nome_tabela}->{$campo} : old('{$campo}') ?>' class='form-control'>\n" .
                "</div>\n";
        }

        return "" .
            "@extends('admin.index_admin')\n" .
            "@section('title', '{$nome_tabela_uc}')\n" .
            "\n" .
            "@section('actions')\n" .
            "   <a href='<?php echo url('/admin/{$nome_tabela}'); ?>' class='btn btn-primary'>\n" .
            "      Voltar\n" .
            "  </a>" .
            "@endsection\n" .
            "\n" .
            "@section('content')\n" .
            "\n" .
            "<div class='card'>\n" .
            "<div class='card-body'>\n" .
            "\n" .
            "" .
            "
<div class='row'>
    <div class='col-md-12'>
        <div class='form-horizontal'>
            @include('commons/alerts')
            <form action='{{ route('{$nome_tabela}.store') }}' method='post'>
                @csrf
                @include('admin.{$nome_tabela}._partials.{$nome_tabela}_form')
            </form>
        </div>
    </div>
</div>
@endsection

" .
            "";
    }

    private function view_list_content($nome_tabela, $campos, $campo1, $campo2) {

        $nome_tabela_uc = ucfirst($nome_tabela);

        $inputs = "";
        $titulos = "";
        foreach ($campos as $k => $campo) {
            if ($k == 0 ||  in_array($campo, ['id', 'created_at', 'updated_at', 'uuid'])) {
                continue;
            }

            $nome_campo = ucfirst($campo);

            $inputs .= " <td><?php echo \$dado->{$campo}; ?></td>";
            $titulos .= " <th>{$nome_campo}</th>";
        }
        $titulos .= " <th></th>";

        return "" .
            "@extends('admin.index_admin')\n" .
            "@section('title', '{$nome_tabela_uc}')\n" .
            "\n" .
            "@section('actions')\n" .
            "<a href='<?php echo url('admin/{$nome_tabela}/create') ?>' class='btn btn-primary'>\n" .
            "Cadastrar\n" .
            "</a>\n" .
            "@endsection\n" .
            "\n" .
            "@section('content')\n" .
            "\n" .
            "<div class='card'>\n" .
            "<div class='card-body'>\n" .
            "\n" .
            "<div class='row'>" .
            "<div class='col-md-12'>" .
            "" .
            " 
            <form action=\"\" method='get'>
                @csrf
                <div class='form-row'>
                    <div class='col-md-2'>
                        <label>{$campo2}</label>
                        <input type='text' name='{$campo2}' value=\"{{ \$filters['{$campo2}'] ?? '' }}\" class='form-control'>
                    </div>
                    <div class='col-md-2'>
                        <label>&nbsp;</label>
                        <input type='submit' value='Pesquisar' class='form-control btn btn-primary'>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <hr>

    <table class='table table-bordered table-hover'>
        <thead>
            <tr>
              {$titulos}
            </tr>
        </thead>
        <tbody>
            <?php
            foreach (\${$nome_tabela} as \$key => \$dado) {
            ?>
                <tr>
                    {$inputs}
                    <td>
                        <a href='<?php echo url('admin/{$nome_tabela}/' . \$dado->{$campo1}.'/edit') ?>' class='btn btn-primary btn-xs'>
                            <span class='fa fa-edit'></span>
                        </a>
                        <a href='<?php echo url('admin/{$nome_tabela}/' . \$dado->{$campo1}) ?>' class='btn btn-danger btn-xs'>
                            <span class='fa fa-trash'></span>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    {{ \${$nome_tabela}->appends(\$filters)->links() }}
</div>
</div>
" .
            "\n" .
            "@endsection" .
            "";
    }
}

/* File system */