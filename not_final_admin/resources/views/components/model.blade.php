<!-- Modal Body -->
<div class="modal fade" id="uniquemodel" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body">
                <div class="text-center">
                    <span class="success-icon py-3 px-3">
                        @if (session('type') == 'success')
                        <i style="font-size: 80px; color: #23bf23b5;" class="bi bi-check2-circle"></i>
                        @elseif (session('type') == 'error')
                        <i style="font-size: 80px;color:#ff0000ad;" class="bi bi-x-circle"></i>
                        @endif
                        </span>
                </div>
                <div class="text-center my-2 mb-2">
                    <h3 class="model_title">
                        {{session('message')}}
                    </h3>
                    <button type="button" class="btn btn-secondary col"
                        data-bs-dismiss="modal">Close</button>
                    @if (!$slot->isEmpty())
                        {{ $slot }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Your other content -->
@if (session('type'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var myModal = new bootstrap.Modal(document.getElementById('uniquemodel'));
            myModal.show();
        });
    </script>
@endif
