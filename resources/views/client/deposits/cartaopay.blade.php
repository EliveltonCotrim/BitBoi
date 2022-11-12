<div>
    @section('title','Checkout')
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    <div class="py-16 px-4 md:px-6 2xl:px-0 flex justify-center items-center 2xl:mx-auto 2xl:container">
        <!--- more free and premium Tailwind CSS components at https://tailwinduikit.com/ --->
        <div class="flex flex-col justify-start items-start w-full space-y-9">


            <div class="flex flex-row xl:flex-row justify-center space-y-6 xl:space-y-0 xl:space-x-6 w-full m-auto">

                <div class="p-8 bg-gray-100 dark:bg-gray-800 flex flex-col lg:w-full xl:w-3/5">
                    <p class="text-3xl lg:text-4xlfont-semibold leading-7 lg:leading-9 text-gray-800 dark:text-gray-50 text-center">
                        Pagar com Cartão
                    </p>
                    <div class="flex justify-start flex-col items-start space-y-2">
                        <a href="{{ url('client/meu_plano') }}" class="flex flex-row items-center text-gray-600 dark:text-white hover:text-gray-500 space-x-1">
                            <svg class="fill-stroke" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.91681 7H11.0835" stroke="currentColor" stroke-width="0.666667" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M2.91681 7L5.25014 9.33333" stroke="currentColor" stroke-width="0.666667" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M2.91681 7.00002L5.25014 4.66669" stroke="currentColor" stroke-width="0.666667" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="text-sm leading-none">
                                Voltar
                            </p>
                        </a>
                    </div>
                    <div class="flex flex-row justify-center items-center mt-6">
                        <hr class="border w-full" />
                        <p class="flex flex-shrink-0 px-4 text-base leading-4 text-gray-600 dark:text-white"></p>
                        <hr class="border w-full" />
                    </div>

                    <label class="mt-8 text-base leading-4 font-bold text-gray-800 dark:text-gray-50">Dados do Titular do Cartão</label>
                    <hr>

                    <div class="mt-2 flex flex-col md:flex-row  gap-2">
                        <div class="w-full md:w-1/2">
                            <label class="mt-8 text-base leading-4 text-gray-800 dark:text-gray-50">
                                Nome do Titular do Cartão
                            </label>
                            <input wire:model.lazy="name" class="border rounded border-gray-300 p-4 w-full text-base leading-4 placeholder-gray-600 text-gray-600" type="text" id="" placeholder="Nome no cartão" />
                        </div>
                        <div class="w-full md:w-1/2">
                            <label class="mt-8 text-base leading-4 text-gray-800 dark:text-gray-50">
                                E-mail do Titular do Cartão
                            </label>
                            <input wire:model.lazy="email" class="border rounded border-gray-300 p-4 w-full text-base leading-4 placeholder-gray-600 text-gray-600" type="text" id="" placeholder="E-mail" />
                        </div>
                    </div>

                    <div class="mt-2 flex flex-col md:flex-row  gap-2">
                        <div class="w-full md:w-1/2">
                            <label class="mt-8 text-base leading-4 text-gray-800 dark:text-gray-50">
                                CPF do Titular do Cartão
                            </label>
                            <input wire:model.lazy="cpf" class="border rounded border-gray-300 p-4 w-full text-base leading-4 placeholder-gray-600 text-gray-600" type="text" id="" placeholder="000.000.000-00" x-data="" x-mask="999.999.999-99" />
                        </div>
                        <div class="w-full md:w-1/2">
                            <label class="mt-8 text-base leading-4 text-gray-800 dark:text-gray-50">
                                Telefone
                            </label>
                            <input wire:model.lazy="telefone" class="border rounded border-gray-300 p-4 w-full text-base leading-4 placeholder-gray-600 text-gray-600" type="text" id="" placeholder="(00) 0 0000-0000" x-data="" x-mask="(99) 9 9999-9999" />
                        </div>
                    </div>


                    <div class="mt-2 flex flex-col md:flex-row  gap-2">
                        <div class="w-full md:w-1/2">
                            <label class="mt-8 text-base leading-4 text-gray-800 dark:text-gray-50">
                                CEP
                            </label>
                            <input wire:model.lazy="cep" class="border rounded border-gray-300 p-4 w-full text-base leading-4 placeholder-gray-600 text-gray-600" type="text" id="" placeholder="00.000-000" x-data="" x-mask="99.999-999" />
                        </div>

                        <div class="w-full md:w-1/2">
                            <label class="mt-8 text-base leading-4 text-gray-800 dark:text-gray-50">
                                Endereço
                            </label>
                            <input wire:model.lazy="endereco" class="border rounded border-gray-300 p-4 w-full text-base leading-4 placeholder-gray-600 text-gray-600" type="text" id="" placeholder="Rua ... " />
                        </div>

                    </div>

                    <div>
                        @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                        @endif
                    </div>



                    <label class="mt-8 text-base leading-4 font-bold text-gray-800 dark:text-gray-50">Dados do Cartão</label>
                    <div class="mt-2 flex-col">
                        <div>
                            <input wire:model.lazy="card_number" class="border rounded-tl rounded-tr border-gray-300 p-4 w-full text-base leading-4 placeholder-gray-600 text-gray-600" type="text" placeholder="0000 0000 0000 0000" />
                        </div>
                        <div class="flex-row flex">
                            <input wire:model.lazy="date" class="border rounded-bl border-gray-300 p-4 w-full text-base leading-4 placeholder-gray-600 text-gray-600" type="text" name="" id="" placeholder="MM/AA" x-data="" x-mask="99/99" />
                            <input wire:model.lazy="cvv" class="border rounded-br border-gray-300 p-4 w-full text-base leading-4 placeholder-gray-600 text-gray-600" type="text" name="" id="" placeholder="CVC" x-data="" x-mask="999" />
                        </div>
                    </div>


                    <div class="mt-2 flex flex-col md:flex-row  gap-2">

                        <div class="w-full ">
                            <label class="mt-8 text-base leading-4 text-gray-800 dark:text-gray-50">
                                Parcela(s)
                            </label>
                            <select wire:model="parcela" class="border bg-white rounded border-gray-300 p-4 w-full text-base leading-4 placeholder-gray-600 text-gray-600">

                                @foreach($parcelas as $parcel)
                                <option value="{{ $parcel['quantidade'] }}">{{ $parcel['quantidade'] }} X @money($parcel['valor'])</option>
                                @endforeach


                            </select>
                        </div>

                    </div>


                    <div class="mt-5 text-red-500 bg-red-100 @if($message) p-2 @endif" wire:loading.class.remove="text-red-500" wire:loading.remove>
                        {!! $message !!}
                    </div>



                    <div wire:loading wire:target="process" class="mt-5 text-red-500 bg-red-100 p-2">
                        Processando Pagamento...
                    </div>

                    <button wire:click="process()" wire:loading.attr="disabled" wire:loading.class.remove="bg-gray-900 hover:bg-black" class="mt-4 border border-transparent hover:border-gray-300 dark:bg-white dark:hover:bg-gray-900 dark:text-gray-900 dark:hover:text-white dark:border-transparent bg-gray-900 hover:bg-black text-white hover:text-white-900 flex justify-center items-center py-4 rounded w-full">
                        <div>
                            <p class="text-base leading-4">Pagar </p>
                        </div>
                    </button>
                </div>

            </div>
        </div>
    </div>



</div>