@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de usuários</h3>
            {!! Button::primary(Icon::user() . ' Novo usuário')->asLinkTo(route('admin.users.create')) !!}
        </div>

        <div class="row">
            {!!
                Table::withContents($users->items())
                ->striped()
                ->callback('Ações', function($field, $model){
                    $linkEdit = route('admin.users.edit', ['usernpm ' => $model->id]);
                    $linkShow = route('admin.users.show', ['user' => $model->id]);

                    return Button::link(Icon::pencil() . ' Editar')->asLinkTo($linkEdit). '|' .
                           Button::link(Icon::eyeOpen() . ' Ver')->asLinkTo($linkShow);
                })
            !!}
        </div>

        {{ $users->links() }}
    </div>
@endsection()