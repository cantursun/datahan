<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('homepage') ?? '#' }}">DATAHAN</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('homepage') ?? '# ' }}">Anasayfa</a>
                </li>
                @if(isset($abouts) && count($abouts)>0)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Hakkımızda</a>
                    <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                        @foreach($abouts as $about)
                            @if($about->is_published)
                                <li><a class="dropdown-item" href="#{{ $about->slug  ?? ''}}">{{ $about->title  ?? ''}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </li>
                @endif

                @if(isset($portfolios) && count($portfolios)>0)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="portfolioDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Portfolyo</a>
                    <ul class="dropdown-menu" aria-labelledby="portfolioDropdown">
                        @foreach($portfolios as $portfolio)
                            @if($portfolio->is_published)
                                <li><a class="dropdown-item" href="#{{ $portfolio->slug  ?? ''}}">{{ $portfolio->title  ?? ''}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="#contact">İletişim</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
