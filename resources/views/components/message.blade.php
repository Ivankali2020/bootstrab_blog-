@if(session('message'))

    <script>
        let arr = @json(session('message'));
            console.log(arr);
        Swal.fire({
            position: 'center',
            icon: arr.icon,
            title: arr.title,
            showConfirmButton: false,
            timer: 2000
        })
    </script>

@endif
