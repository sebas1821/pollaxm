@section('title', __('Cambiarpassword'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-m-6 col-lg-4">
            <div class="card shadow p-3 mb-5 bg-body rounded">
                <div class=" ">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <h4><i class="fa-solid fa-square-poll-horizontal text-info"></i>
                                Cambiar Contraseña </h4>
                        </div>
                        @if (session()->has('message'))
                
                            <div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;">
                                {{ session('message') }} </div>
                        @endif

                    </div>
                </div>
                <br>
                <form>
                <div class="form-group">
               
                <label for="inputPassword5" class="form-label">Nueva contraseña</label>
                <input wire:model="newpassword" type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock"> 
                @error('newpassword')
                <span class="error text-danger">{{ $message }}</span>
            @enderror
                <div id="passwordHelpBlock" class="form-text">
                    La nueva contraseña debe tener minimo 8 caracteres. (ejemplo: 12345678......)
                </div>
                <br>
            </form>
            </div>
                    <button type="button" wire:click.prevent="updatePassword({{auth()->id()}})"
                        class="btn btn-primary">Cambiar</button>
            </div>
        </div>

    </div>

</div>
@push('custom-scripts')
    {{-- <script>

        Livewire.on('evento', rId => {
        
                Swal.fire({
                    title: 'Pollaxm',
                    text: "Seguro que desea actualizar la contraseña ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Cambiar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.call('updatePassword', rId);
                        Swal.fire(
                            'Actualizar!',
                            'Ha sido actualizada con éxito.',
                            'success'
                        )
                    }
        
                })
        
            });
        </script> --}}
@endpush
