<script src="{{ asset('src/js/vendor/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('plugins/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('plugins/screenfull/dist/screenfull.js') }}"></script>


<!-- Stack array for including inline js or scripts -->
@stack('script')
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@10"])
<script src="{{ asset('dist/js/theme.js') }}"></script>
<script src="{{ asset('js/chat.js') }}"></script>