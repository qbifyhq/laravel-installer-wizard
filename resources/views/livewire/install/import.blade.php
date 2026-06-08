<div class="page page-center">
   <div class="container container-tight py-4">
      <div class="text-center mb-4">
         <img src="{{asset('assets/images/logo.png')}}" alt="" style=" height: 50px; ">
      </div>

      <div class="card card-md">
         <div class="card-body text-center">

            @if($migrated)
                  <!-- SUCCESS -->
                  <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64"
                     viewBox="0 0 24 24" fill="none" stroke="green"
                     stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                     class="icon icon-lg mb-3 text-success">
                     <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                     <path d="M9 12l2 2l4 -4"></path>
                  </svg>

                  <h2 class="h2 mb-2">Database Imported Successfully!</h2>

                  <p class="text-muted mb-4">
                     All migrations have been executed successfully.
                  </p>

                  <a href="{{ url('/') }}" wire:navigate class="btn btn-primary w-100">
                     Finish Installation
                  </a>

            @else
                  <!-- PENDING -->
                  <h2 class="h2 mb-2">Import Database</h2>

                  <p class="text-muted mb-4">
                     Click below to run database migrations and set up your system.
                  </p>

                  @error('migration')
                     <div class="alert alert-danger">{{ $message }}</div>
                  @enderror

                  <button
                     wire:click="runMigrations"
                     class="btn btn-primary w-100"
                     wire:loading.attr="disabled"
                  >
                     <span wire:loading.remove>Run Migration</span>
                     <span wire:loading>Running...</span>
                  </button>
            @endif

         </div>
      </div>

      <div class="text-center text-muted mt-3">
         <small>Need help? Contact support at {{config('installer-info.support_email')}}</small>
      </div>
   </div>
</div>