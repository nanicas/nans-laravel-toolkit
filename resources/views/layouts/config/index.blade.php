@extends('layouts.dashboard')
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
                    <span class="badge badge-primary float-right">128</span>
                </li>
                <li class="list-group-item text-left">
                    <strong>Posts</strong>
                    <span class="badge badge-primary float-right">132</span>
                </li>
                <li class="list-group-item text-left">
                    <strong>Seguidores</strong>
                    <span class="badge badge-primary float-right">141</span>
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
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    @foreach($tab_options as $tab => $tabDescription)
                        @php
                            $isCurrent = ($screen  == $tab);
                        @endphp
                        <a class="nav-link {{ ($isCurrent) ? 'active' : '' }}" id="nav-{{ $tab }}-tab" data-toggle="tab" href="{{ route($tab . '.index') }}" role="tab" aria-controls="nav-{{ $tab }}" aria-selected="{{ ($isCurrent) ? 'true' : 'false' }}">{{ $tabDescription }}</a>
                    @endforeach
                </div>
            </nav>
            <div class="tab-content">
                <br>
                <div class="tab-pane fade show active" id="nav-{{ $screen }}-tab" role="tabpanel" aria-labelledby="nav-{{ $screen }}-tab">
                    @yield('config-content')
                </div>
            </div><!--/tab-pane-->
        </div><!--/tab-content-->

    </div><!--/col-9-->
</div><!--/row-->
@endsection