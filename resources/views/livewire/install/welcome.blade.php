<div class="page page-center">
   <div class="container container-tight py-4">
      <div class="text-center mb-4">
            <img src="{{asset('assets/images/logo.png')}}" alt="" style=" height: 50px; ">
      </div>
      <div class="card card-md">
         <div class="card-body p-5">
            <h2 class="h2 text-center mb-4">Welcome</h2>
            <p class="text-muted mb-4">
               This installer will guide you through the setup process.
            </p>
            <div class="mb-4">
               <div class="d-flex align-items-center mb-3">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon text-success me-2"><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path><path d="M9 12l2 2l4 -4"></path></svg>
                  <span>Quick and easy installation process</span>
               </div>
               <div class="d-flex align-items-center mb-3">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon text-success me-2"><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path><path d="M9 12l2 2l4 -4"></path></svg>
                  <span>Database configuration in minutes</span>
               </div>
            </div>

            <div class="alert alert-info d-flex align-items-center">
               <i class="ti ti-info-circle"></i>
               <span>
                  Please ensure your server meets the minimum requirements before proceeding.
               </span>
            </div>

            <div class="form-footer">
               <a class="btn btn-primary w-100" href="{{route('install.verify')}}" wire:navigate>Next</a>
            </div>
         </div>
      </div>

      <div class="text-center text-muted mt-3">
         <small>Need help? Contact support at {{config('installer-info.support_email')}}</small>
      </div>
   </div>
</div>