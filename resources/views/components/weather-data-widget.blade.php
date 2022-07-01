<div class="container py-5 h-100">

    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-8 col-lg-6 col-xl-4">

            <div class="card" style="color: #4B515D; border-radius: 35px;">
                <div class="card-body p-4">

                    <div class="d-flex">
                        <h6 class="flex-grow-1">{{ ucfirst($location) }}</h6>
                    </div>

                    @if ($errorMessage)
                        <div class="alert alert-danger" role="alert">
                            {{ $errorMessage }}
                        </div>
                    @else
                        <div class="d-flex flex-column text-center mt-5 mb-4">
                            <h6 class="display-4 mb-0 font-weight-bold" style="color: #1C2331;">
                                {{ $weatherData['main']['temp'] }} °C </h6>
                            <span class="small" style="color: blue">Feels like:
                                {{ $weatherData['main']['feels_like'] }} °C</span>
                            <span class="small"
                                style="color: #868B94">{{ ucfirst($weatherData['weather'][0]['main']) }} -
                                {{ ucfirst($weatherData['weather'][0]['description']) }}</span>

                            <div>
                                <img src="https://openweathermap.org/img/wn/{{ $weatherData['weather'][0]['icon'] }}@4x.png"
                                    alt="{{ ucfirst($weatherData['weather'][0]['main']) }}">
                            </div>

                        </div>

                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1" style="font-size: 1rem;">
                                <div><i class="fas fa-wind fa-fw" style="color: #868B94;"></i> <span class="ms-1">
                                        {{ $weatherData['wind']['speed'] }} km/h</span></div>
                                <div><i class="fas fa-tint fa-fw" style="color: #868B94;"></i> <span class="ms-1">
                                        {{ $weatherData['main']['humidity'] }}% </span></div>
                            </div>
                        </div>
                </div>
                @endif

            </div>
        </div>

    </div>
</div>

</div>
