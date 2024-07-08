{{-- ////////////////////////////////////////////////////////////////////// TOAST //////////////////////////////////////////////////////////////////////  --}}
{{-- TOAST: VALIDATION ERROR/FAILED --}}
@if ($errors->any())
    @php
        $errorMessages = $errors->all();
    @endphp

    @foreach ($errorMessages as $index => $message)
        @if ($index == 0)
            <input type="hidden" class="error-message" data-delay="{{ ($index + 1) * 0 }}" value="{{ $message }}">
        @else
            <input type="hidden" class="error-message" data-delay="{{ ($index + 1) * 1000 }}" value="{{ $message }}">
        @endif
    @endforeach
@endif
<script>
    $(document).ready(function() {
        @if ($errors->any())
            @php
                $errorMessages = $errors->all();
            @endphp

            @foreach ($errorMessages as $index => $message)
                var toastErrorMsg_{{ $index }} = "{{ $message }}";
                var delay_{{ $index }} = {{ ($index + 1) * 1000 }};

                setTimeout(function() {
                    toastr.error(toastErrorMsg_{{ $index }}, '', {
                        closeButton: false,
                        debug: false,
                        newestOnTop: false,
                        progressBar: true,
                        positionClass: 'toast-top-right',
                        preventDuplicates: false,
                        onclick: null,
                        showDuration: '300',
                        hideDuration: '1000',
                        timeOut: '5000',
                        extendedTimeOut: '1000',
                        showEasing: 'swing',
                        hideEasing: 'linear',
                        showMethod: 'fadeIn',
                        hideMethod: 'fadeOut'
                    });
                }, delay_{{ $index }});
            @endforeach
        @endif
    });
</script>





{{-- TOAST: SUCCESS --}}
@if (Session::has('success'))
    @foreach (Session::get('success') as $index => $message)
        @if ($index == 1)
            <input type="hidden" class="success-message" data-delay="{{ ($index + 1) * 0 }}"
                value="{{ $message }}">
        @else
            <input type="hidden" class="success-message" data-delay="{{ ($index + 1) * 1000 }}"
                value="{{ $message }}">
        @endif
    @endforeach
@endif

<script>
    $(document).ready(function() {
        @if (Session::has('success'))
            @foreach (Session::get('success') as $index => $message)
                var toastSuccessMsg_{{ $index }} = "{{ $message }}";
                var delay_{{ $index }} = {{ ($index + 1) * 1000 }};

                setTimeout(function() {
                    toastr.success(toastSuccessMsg_{{ $index }}, '', {
                        closeButton: false,
                        debug: false,
                        newestOnTop: false,
                        progressBar: true,
                        positionClass: 'toast-top-right',
                        preventDuplicates: false,
                        onclick: null,
                        showDuration: '300',
                        hideDuration: '1000',
                        timeOut: '5000',
                        extendedTimeOut: '1000',
                        showEasing: 'swing',
                        hideEasing: 'linear',
                        showMethod: 'fadeIn',
                        hideMethod: 'fadeOut'
                    });
                }, delay_{{ $index }});
            @endforeach
        @endif
    });
</script>





{{-- TOAST: NORMAL ERROR MESSAGE --}}
@if (Session::has('n_errors'))
    @foreach (Session::get('n_errors') as $index => $message)
        @if ($index == 1)
            <input type="hidden" class="n-error-message" data-delay="{{ ($index + 1) * 0 }}"
                value="{{ $message }}">
        @else
            <input type="hidden" class="n-error-message" data-delay="{{ ($index + 1) * 1000 }}"
                value="{{ $message }}">
        @endif
    @endforeach
@endif
<script>
    $(document).ready(function() {
        @if (Session::has('n_errors'))
            @foreach (Session::get('n_errors') as $index => $message)
                var toastNErrorMsg_{{ $index }} = "{{ $message }}";
                var delay_{{ $index }} = {{ ($index + 1) * 1000 }};

                setTimeout(function() {
                    toastr.error(toastNErrorMsg_{{ $index }}, '', {
                        closeButton: false,
                        debug: false,
                        newestOnTop: false,
                        progressBar: true,
                        positionClass: 'toast-top-right',
                        preventDuplicates: false,
                        onclick: null,
                        showDuration: '300',
                        hideDuration: '1000',
                        timeOut: '5000',
                        extendedTimeOut: '1000',
                        showEasing: 'swing',
                        hideEasing: 'linear',
                        showMethod: 'fadeIn',
                        hideMethod: 'fadeOut'
                    });
                }, delay_{{ $index }});
            @endforeach
        @endif
    });
</script>

{{-- ////////////////////////////////////////////////////////////////////// ./TOAST //////////////////////////////////////////////////////////////////////  --}}
