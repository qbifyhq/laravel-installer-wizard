<div class="page page-center">
   <div class="container container-tight py-4">
      <div class="text-center mb-4">
         <img src="{{asset('assets/images/logo.png')}}" alt="" style=" height: 50px; ">
      </div>
      <div class="card card-md">
         <div class="card-body">
            <h2 class="h2 text-center mb-4">Database Configuration</h2>

            <p class="text-muted text-center mb-4">Enter your database connection details below.</p>

            <form wire:submit.prevent="submit">
               <div class="mb-3">
                  <label for="db_driver" class="form-label">Database Driver <div wire:loading wire:target="db_driver" class="spinner-border spinner-border-sm ms-2 text-primary" role="status"><span class="visually-hidden">Loading...</span></div></label>

                  <select id="db_driver" wire:model.live="db_driver" class="form-select">
                     <option value="">Select your database driver</option>
                     <option value="mysql">MySQL / MariaDB</option>
                     <option value="pgsql">PostgreSQL</option>
                     <option value="sqlite">SQLite</option>
                     <option value="sqlsrv">SQL Server</option>
                  </select>

                  <small class="text-muted">Select your database driver</small>

                  @error('db_driver')
                     <div class="text-danger small mt-1">{{ $message }}</div>
                  @enderror
               </div>

               @if($db_driver != 'sqlite')
               <!-- Database Host -->
               <div class="mb-3">
                  <label for="db_host" class="form-label">Database Host</label>

                  <input type="text" id="db_host" wire:model="db_host" class="form-control" placeholder="127.0.0.1">

                  <small class="text-muted">Usually 127.0.0.1 or localhost</small>

                  @error('db_host')
                     <div class="text-danger small mt-1">{{ $message }}</div>
                  @enderror
               </div>

               <!-- Database Port -->
               <div class="mb-3">
                  <label for="db_port" class="form-label">Database Port</label>

                  <input type="text" id="db_port" wire:model="db_port" class="form-control" placeholder="3306">

                  <small class="text-muted">Default MySQL port is 3306, PostgreSQL is 5432</small>

                  @error('db_port')
                     <div class="text-danger small mt-1">{{ $message }}</div>
                  @enderror
               </div>

               <!-- Database Name -->
               <div class="mb-3">
                  <label for="db_name" class="form-label">Database Name</label>

                  <input type="text" id="db_name" wire:model="db_name" class="form-control" placeholder="qube_db">

                  @error('db_name')
                     <div class="text-danger small mt-1">{{ $message }}</div>
                  @enderror
               </div>

               <!-- Database Username -->
               <div class="mb-3">
                  <label for="db_user" class="form-label">Database Username</label>

                  <input type="text" id="db_user" wire:model="db_user" class="form-control" placeholder="root">

                  @error('db_user')
                     <div class="text-danger small mt-1">{{ $message }}</div>
                  @enderror
               </div>

               <!-- Database Password -->
               <div class="mb-3">
                  <label for="db_pass" class="form-label">Database Password</label>

                  <input type="text" id="db_pass" wire:model="db_pass" class="form-control" placeholder="Leave blank if no password">

                  @error('db_pass')
                     <div class="text-danger small mt-1">{{ $message }}</div>
                  @enderror
               </div>
                @endif

               @if($db_driver == 'sqlite')
               <div class="mb-3">
                  <label for="sqlite_path" class="form-label">SQLite Database Path</label>

                  <input type="text" id="sqlite_path" wire:model="sqlite_path" class="form-control" placeholder="{{ database_path('database.sqlite') }}">

                  <small class="text-muted">Example: {{ database_path('database.sqlite') }}</small>

                  @error('sqlite_path')
                     <div class="text-danger small mt-1">{{ $message }}</div>
                  @enderror
               </div>
               @endif

               <!-- Form Action Buttons -->
               <div class="d-flex gap-3">
                  <a class="btn btn-secondary" href="{{route('install.requirements')}}" wire:navigate>Back</a>

                  <button type="submit" class="btn btn-primary w-100" wire:loading.attr="disabled" wire:target="submit" > <span wire:loading.remove wire:target="submit"> Connect </span> <span wire:loading wire:target="submit"> Connecting... </span> </button>
               </div>
            </form>
         </div>
      </div>
      <div class="text-center text-muted mt-3">
         <small>Need help? Contact support at {{config('installer-info.support_email')}}</small>
      </div>
   </div>
</div>