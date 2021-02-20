@extends('layouts.app')

@section('content')
<style>
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                <div class="logo_block"><img src="img/healthylives.jpg"></div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    ログイン完了しました！
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
