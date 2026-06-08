<div class="page page-center">
   <div class="container container-tight py-4">

      <div class="text-center mb-4">
            <img src="{{asset('assets/images/logo.png')}}" alt="" style=" height: 50px; ">
      </div>

      <div class="card card-md">
         <div class="card-body p-5">

            <h2 class="h2 text-center mb-4">System Requirements Check</h2>

            {{-- ENVIRONMENT CORE --}}
            <h3 class="h4 mb-3">Environment Core</h3>

            <div class="border rounded p-3 mb-4">
               <div class="mb-2">
                  <strong>PHP Version:</strong> {{ $currentPhpVersion }}

                  @if(version_compare($currentPhpVersion, $recPhpVersion, '>='))
                     <span class="badge bg-success text-blue-fg ms-2">Excellent (8.5+)</span>

                  @elseif(version_compare($currentPhpVersion, $minPhpVersion, '>='))
                     <span class="badge bg-yellow text-yellow-fg ms-2">Compatible (8.3+)</span>
                  @else
                     <span class="badge bg-danger text-red-fg ms-2">Incompatible (Requires 8.3+)</span>
                  @endif
               </div>

               <div>
                  <strong>HTTPS:</strong>
                  @if($isHttps)
                     <span class="badge bg-success text-blue-fg">Enabled</span>
                  @else
                     <span class="badge bg-danger text-red-fg">Disabled</span>
                  @endif
               </div>
            </div>

            {{-- EXTENSIONS --}}
            <h3 class="h4 mb-3">Required Extensions</h3>

            @foreach($requirements as $ext)
                <div class="d-flex justify-content-between align-items-center border rounded p-3 mb-2">
                    <div>
                        <strong>{{ $ext }}</strong>
                        <div class="small text-muted">
                            Required: Enabled | Current: 

                            @if(extension_loaded($ext))
                                Enabled
                            @else
                                Disabled
                            @endif
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        @if(extension_loaded($ext))
                            <i class="ti ti-circle-check text-success" style="font-size: 1.25rem;"></i>
                            <span class="text-success fw-bold">Passed</span>
                        @else
                            <i class="ti ti-x text-danger" style="font-size: 1.25rem;"></i>
                            <span class="text-danger fw-bold">Failed</span>
                        @endif
                    </div>
                </div>
            @endforeach
            
            {{-- CHECK LOGIC --}}
            @php
               $allExtensionsLoaded = collect($requirements)
                  ->every(fn($ext) => extension_loaded($ext));

               $phpVersionOk = version_compare($currentPhpVersion, $minPhpVersion, '>=');

               $allRequirementsMet = $phpVersionOk && $allExtensionsLoaded;
            @endphp

            {{-- STATUS UI --}}
            @if(!$allRequirementsMet)
               <div class="alert alert-danger d-flex align-items-center" role="alert">
                  <i class="ti ti-circle-x me-2"></i>
                  <span>
                     Some requirements are not met. Please fix them before continuing.
                  </span>
               </div>

               <a class="btn btn-danger w-100" href="{{route('install.requirements')}}" wire:navigate>Try Again</a>
            @else
               <div class="alert alert-success d-flex align-items-center" role="alert">
                  <i class="ti ti-circle-check me-2"></i>
                  <span>
                     All requirements are met! You can continue.
                  </span>
               </div>

               <div class="d-flex gap-3">
                  <a class="btn btn-secondary" href="{{route('install.welcome')}}" wire:navigate>Back</a>

                  <a class="btn btn-primary flex-grow-1" href="{{route('install.database')}}" wire:navigate>Next: Database Setup</a>
               </div>
            @endif

         </div>
      </div>

      <div class="text-center text-muted mt-3">
         <small>Need help? Contact support at {{config('installer-info.support_email')}}</small>
      </div>
   </div>
</div>