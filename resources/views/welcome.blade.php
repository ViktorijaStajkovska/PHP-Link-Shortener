<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body class="bg-black text-light  mw">
    <div class="container mt-1">
        <div class="row">
            <div class="col">

                @if(Session::has('success'))
                <div class="alert alert-success" role="alert" id="successAlert">
                    {{ Session::get('success') }}
                </div>
                @endif

                @if(Session::has('error'))
                <div class="alert alert-danger" role="alert" id="errorAlert">
                    {{ Session::get('error') }}
                </div>
                @endif
                <form action="{{ route('link.shorten') }}" method="post" class="mt-5">
                    @csrf
                    <div class="d-flex align-items-end">
                        <div class="form-group mr-2 flex-grow-1">
                            <label for="url">Enter URL:</label>
                            <input type="text" class="form-control bg-black @error('url') is-invalid @enderror" name="url" id="url" placeholder="Url">
                            @error('url')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-secondary mb-3">Shorten URL</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h1 class="mt-5">List of Shortened URLs</h1>
                <table class="table text-light  table-responsive">
                    <thead class="thead-secondary">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Long Url</th>
                            <th scope="col">Short Url</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($urls as $url)
                        <tr>
                            <th scope="row">{{ $url->id }}</th>
                            <td><a href="{{ url($url->original_url) }}">{{ url( $url->original_url) }}</a></td>
                            <td><a href="{{ route('link.redirect', ['shortCode' => $url->short_code]) }}" onclick="reloadOnce()">{{ url( $url->short_code) }}</a></td>
                            <td>
                                <p>{{ $url->hits }}</p>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>


    </div>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Function to fade out success alert smoothly
    setTimeout(function() {
        var successAlert = document.getElementById('successAlert');
        if (successAlert) {
            successAlert.style.transition = 'opacity 1s ease';
            successAlert.style.opacity = '0';
            setTimeout(function() {
                successAlert.style.display = 'none';
            }, 1000);
        }
    }, 3000);

    // Function to fade out error alert smoothly
    setTimeout(function() {
        var errorAlert = document.getElementById('errorAlert');
        if (errorAlert) {
            errorAlert.style.transition = 'opacity 1s ease';
            errorAlert.style.opacity = '0';
            setTimeout(function() {
                errorAlert.style.display = 'none';
            }, 1000);
        }
    }, 3000);

    var reloadOnceFlag = false;

    function reloadOnce() {
        if (!reloadOnceFlag) {
            console.log(reloadOnceFlag)
            window.reload();
            reloadOnceFlag = true;


        }
        reloadOnceFlag = false;
    }
</script>

<style>
    .bg-black {
        background-color: #202020;
    }

    .mw {
        max-width: 100vw;
    }

    .table-responsive {
        overflow-x: auto;
        /* Allow horizontal scrolling */
    }
</style>