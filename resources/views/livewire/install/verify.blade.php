<div class="page page-center">
   <div class="container container-tight py-4">
      <div class="text-center mb-4">
         <img src="{{asset('assets/images/logo.png')}}" alt="" style=" height: 50px; ">
      </div>
      <div class="card card-md">
         <div class="card-body">
            <h2 class="h2 text-center mb-4">Verify License</h2>

            <p class="text-muted text-center mb-4">Enter your license key below.</p>

            <form wire:submit.prevent="verifyLicense">
                <!-- License Key -->
               <div class="mb-3">
                  <label for="license_key" class="form-label">License Key</label>

                  <input type="text" id="license_key" wire:model="license_key" class="form-control" placeholder="XXXX-XXXX-XXXX-XXXX">

                  @error('license_key')
                     <div class="text-danger small mt-1">
                           {{ $message }}
                     </div>
                  @enderror
               </div>

               <!-- Form Action Buttons -->
               <div class="d-flex gap-3">
                  <a class="btn btn-secondary" href="{{route('install.welcome')}}" wire:navigate>Back</a>

                  <button type="submit" class="btn btn-primary w-100" wire:loading.attr="disabled" wire:target="verifyLicense" > <span wire:loading.remove wire:target="verifyLicense"> Verify License </span> <span wire:loading wire:target="verifyLicense"> Verifying... </span> </button>
               </div>
            </form>
         </div>
      </div>
      <div class="text-center text-muted mt-3">
         <small>Need help? Contact support at {{config('installer-info.support_email')}}</small>
      </div>
   </div>
</div>