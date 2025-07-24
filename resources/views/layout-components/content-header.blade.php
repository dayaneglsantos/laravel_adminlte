<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <!-- Essa é a forma de exibir somente se a seção 'page-title' estiver definida. Se não tivessemos colocado isso, a tag seria exibida no html porém não teria conteúdo. -->
                @hasSection('page-title')
                    <h3 class="mb-0">@yield('page-title')</h3>
                @endif

                <!-- Só exibe se existir a variável $breadcrumbs -->
                @isset($breadcrumbs)
                    <ol class="breadcrumb">
                        @foreach ($breadcrumbs as $breadcrumb)
                            <li class="breadcrumb-item"><a href="#">{{ $breadcrumb['label'] }}</a></li>
                        @endforeach
                    </ol>
                @endisset
            </div>
            <div class="col-sm-6">
                Actions
            </div>
        </div>
    </div>
</div>
