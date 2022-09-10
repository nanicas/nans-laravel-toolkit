@extends($view_prefix . 'layouts.dashboard')
@section('dashboard-content')
<div class="container" id='config-box'>
    <div class="row">
        <div class="col-sm-12 text-center">
            <h1></h1>
        </div>
<!--        <div class="col-sm-2"><a href="/users" class="pull-right"><img title="profile image" class="img-circle img-responsive" src="http://www.gravatar.com/avatar/28fd20ccec6865e2d5f0e1f4446eb7bf?s=100"></a></div>-->
    </div>
    <div class="row mt-2">
        <div class="col-sm-3"><!--left col-->
            <div class="text-center">
                <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
                <h6>Atualize sua foto ...</h6>
<!--                <input type="file" class="text-center center-block file-upload">-->
            </div></hr><br>

            <ul class="list-group">
                <li class="list-group-item text-muted text-center">Atividades <i class="fa fa-dashboard fa-1x"></i></li>
                <li class="list-group-item text-left">
                    <strong>Compartilhamentos</strong>
                    <span class="badge badge-primary float-right">125</span>
                </li>
                <li class="list-group-item text-left">
                    <strong>Likes</strong>
                    <span class="badge badge-primary float-right">125</span>
                </li>
                <li class="list-group-item text-left">
                    <strong>Posts</strong>
                    <span class="badge badge-primary float-right">125</span>
                </li>
                <li class="list-group-item text-left">
                    <strong>Seguidores</strong>
                    <span class="badge badge-primary float-right">125</span>
                </li>
            </ul>

            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">
                    <i class="fa fa-facebook fa-2x"></i> <i class="fa fa-github fa-2x"></i> <i class="fa fa-twitter fa-2x"></i> <i class="fa fa-pinterest fa-2x"></i> <i class="fa fa-google-plus fa-2x"></i>
                </div>
            </div>

        </div><!--/col-3-->
        <div class="col-sm-9">

            @php
                $isUserRoute = ($screen  == 'user_config');
                $isDataRoute = ($screen  == 'data_config');
                $isCategoryRoute = ($screen  == 'category_config');
                $isComponentRoute = ($screen  == 'component_config');
                $isEntityRoute = ($screen  == 'entity_config');
            @endphp

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-link {{ ($isUserRoute) ? 'active' : '' }}" id="nav-user-tab" data-toggle="tab" href="{{ route('user_config.index') }}" role="tab" aria-controls="nav-user" aria-selected="{{ ($isUserRoute) ? 'true' : 'false' }}">Usuário</a>
                    <a class="nav-link {{ ($isDataRoute) ? 'active' : '' }}" id="nav-data-tab" data-toggle="tab" href="{{ route('data_config.index') }}" role="tab" aria-controls="nav-data" aria-selected="{{ ($isDataRoute) ? 'true' : 'false' }}">Dado pessoal</a>
                    <a class="nav-link {{ ($isCategoryRoute) ? 'active' : '' }}" id="nav-category-tab" data-toggle="tab" href="{{ route('category_config.index') }}" role="tab" aria-controls="nav-category" aria-selected="{{ ($isCategoryRoute) ? 'true' : 'false' }}">Categoria</a>
                    <a class="nav-link {{ ($isComponentRoute) ? 'active' : '' }}" id="nav-component-tab" data-toggle="tab" href="{{ route('component_config.index') }}" role="tab" aria-controls="nav-component" aria-selected="{{ ($isComponentRoute) ? 'true' : 'false' }}">Componente</a>
                    <a class="nav-link {{ ($isEntityRoute) ? 'active' : '' }}" id="nav-entity-tab" data-toggle="tab" href="{{ route('entity_config.index') }}" role="tab" aria-controls="nav-entity" aria-selected="{{ ($isEntityRoute) ? 'true' : 'false' }}">Entidade</a>
                </div>
            </nav>
            <div class="tab-content">
                <br>
                @if($isUserRoute)
                <div class="tab-pane fade show active" id="nav-user-tab" role="tabpanel" aria-labelledby="nav-user-tab">
                    @yield('config-content')
                </div>
                @endif
                @if($isDataRoute)
                <div class="tab-pane fade show active" id="nav-data-tab" role="tabpanel" aria-labelledby="nav-data-tab">
                    @yield('config-content')
                </div>
                @endif
                @if($isCategoryRoute)
                <div class="tab-pane fade show active" id="nav-category-tab" role="tabpanel" aria-labelledby="nav-category-tab">
                    @yield('config-content')
                </div>
                @endif
                @if($isComponentRoute)
                <div class="tab-pane fade show active" id="nav-component-tab" role="tabpanel" aria-labelledby="nav-component-tab">
                    @yield('config-content')
                </div>
                @endif
                @if($isEntityRoute)
                <div class="tab-pane fade show active" id="nav-entity-tab" role="tabpanel" aria-labelledby="nav-entity-tab">
                    @yield('config-content')
                </div>
                @endif
            </div><!--/tab-pane-->
        </div><!--/tab-content-->

    </div><!--/col-9-->
</div><!--/row-->
@endsection