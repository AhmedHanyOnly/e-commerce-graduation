<script data-navigate-once src="{{ asset('admin-asset/js/bootstrap.bundle.min.js') }}"></script>
<script data-navigate-once src="{{ asset('admin-asset/js/all.min.js') }}"></script>
<script data-navigate-once src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script data-navigate-once src="{{ asset('admin-asset/js/swiper-bundle.min.js') }}"></script>
<script data-navigate-once src="{{ asset('admin-asset/js/main.js') }}"></script>
<script data-navigate-once src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script data-navigate-once>
    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom',
        showConfirmButton: false,
        showCloseButton: true,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    window.addEventListener('alert', ({
        detail: {
            type,
            message
        }
    }) => {
        Toast.fire({
            icon: type,
            title: message
        })
    })
</script>
<script data-navigate-once src="https://code.jquery.com/jquery-3.7.1.js"></script>

@livewireScripts
@stack('js')
