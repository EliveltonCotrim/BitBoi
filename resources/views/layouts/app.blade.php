@extends('client/index_client')


@section('content')

@livewireStyles
@livewireScripts
{{ $slot }}
@endsection