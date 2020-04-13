@if(!session('success') && !session('error'))
    <div id="preloader">
        <div id="status">
            <div class="spinner">Loading...</div>
        </div>
    </div>
@endif

@if(session('success'))
    @push('scripts')
        <script>
            Swal.fire({
                title: "Sucesso!",
                text: "@lang(session('success'))",
                type: "success",
                confirmButtonClass: "btn btn-confirm mt-2"
            })
        </script>
    @endpush
@endif

@if(session('error'))
    @push('scripts')
        <script>
            Swal.fire({
                title: "Opsss!",
                text: "@lang(session('error'))",
                type: "error",
                confirmButtonClass: "btn btn-confirm mt-2"
            })
        </script>
    @endpush
@endif