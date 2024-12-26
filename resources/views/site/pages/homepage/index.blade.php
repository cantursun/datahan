@extends('site._base')
@section('title')DATAHAN @endsection
@section('css')

@endsection

@section('body')
    <div class="container" style="margin-top: 100px;">

        @if(isset($abouts) && count($abouts)>0)
            @foreach($abouts as $about)
                @if($about->is_published)
                    <section id="{{ $about->slug  ?? ''}}">
                        <h2>{{ $about->title  ?? ''}}</h2>
                        <p class="">{!! $about->description  ?? 'Panel üzerinden eklenecek' !!}</p>
                    </section>
                @endif
            @endforeach
        @endif

        @if(isset($portfolios) && count($portfolios)>0)
            @foreach($portfolios as $portfolio)
                @if($portfolio->is_published)
                    <section id="{{ $portfolio->slug  ?? ''}}">
                        <h2>{{ $portfolio->title  ?? ''}}</h2>
                        <p class="">{!! $portfolio->description  ?? 'Panel üzerinden eklenecek' !!}</p>
                    </section>
                @endif
            @endforeach
        @endif

        <section id="contact">
            <h2>İletişim</h2>
            <p class="text-center">Bize ulaşmak için aşağıdaki bilgileri kullanabilirsiniz.</p>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form id="contactForm" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Adınız</label>
                            <input type="text" required name="name" class="form-control" id="name" placeholder="Adınızı girin">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" required name="email" class="form-control" id="email" placeholder="Email adresinizi girin">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Mesajınız</label>
                            <textarea class="form-control" required name="message" id="message" rows="4" placeholder="Mesajınızı yazın"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Gönder</button>
                    </form>
                </div>
            </div>
            <div class="text-center mt-4">
                @if(isset($phone) && !empty($phone->value))
                    <p>Telefon: {{ $phone->value ?? '' }}</p>
                @endif
                @if(isset($address) && !empty($address->value))
                    <p>Adres: {{ $address->value ?? '' }}</p>
                @endif
            </div>
            <div class="text-center">
                @if(isset($mapAddressUrl) && !empty($mapAddressUrl->value))
                    <iframe src="{{ $mapAddressUrl->value ?? '' }}" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                @endif
            </div>
        </section>
    </div>
@endsection

@section('js')

@endsection
