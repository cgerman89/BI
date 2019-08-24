<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green-gradient">
                <i class="far fa-folder"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">
                    <a href="{{ route('dashboard.list.index') }}" class="btn-link">Dashboards</a>
                </span>
                <span class="info-box-number">
                    @isset($counts['countDashboard'])
                        {{ $counts['countDashboard'] }}
                    @else
                        0
                    @endisset
                </span>
                <span class="info-box-more">
                    <a href="{{ route('dashboard.index') }}" class="btn-link">
                       <i class="fas fa-plus"></i> Crear
                    </a>
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua-gradient">
               <i class="fas fa-chart-line"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">
                    <a href="{{ route('graphic.getList.index') }}" class="btn-link">Graficos</a>
                </span>
                <span class="info-box-number">
                       @isset($counts['countGraphic'])
                        {{ $counts['countGraphic'] }}
                    @else
                        0
                    @endisset
                </span>
                <span class="info-box-more">
                    <a href="{{ route('graphic.index') }}" class="btn-link">
                        <i class="fas fa-plus"></i> Crear
                    </a>
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-light-blue-gradient">
               <i class="fas fa-plug"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">
                    <a href="{{ route('Connections.index') }}" class="btn-link">Conexiones</a>
                </span>
                <span class="info-box-number">
                       @isset($counts['countConnection'])
                        {{ $counts['countConnection'] }}
                    @else
                        0
                    @endisset
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-orange-active">
               <i class="fas fa-archive"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">
                    <a href="{{ route('etl.collection.index') }}" class="btn-link">Colecciones</a>
                </span>
                <span class="info-box-number">
                       @isset($counts['countCollection'])
                        {{ $counts['countCollection'] }}
                    @else
                        0
                    @endisset
                </span>
            </div>
        </div>
    </div>
</div>
