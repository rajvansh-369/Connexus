<div>
    @if ($isForgetPage)
        <form id="loginForm" wire:submit.prevent="forgetSubmit">
            <div class="form-group">
                <label class="form-label" for="email">Email Address</label>
                <input type="email" id="email" wire:model.blur="email" class="form-input"
                    placeholder="Enter your email" required>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="login-btn">
                Send Password
                
            </button>
            @if (Session::has('message'))
                <p class="alert-success ">{{ Session::get('message') }}</p>
            @endif
            @if (Session::has('error'))
                <p class="alert-danger ">{{ Session::get('error') }}</p>
            @endif
        </form>
    @else
        <form id="loginForm" wire:submit.prevent="submit">
            <div class="form-group">
                <label class="form-label" for="email">Email Address</label>
                <input type="email" id="email" wire:model.blur="email" class="form-input"
                    placeholder="Enter your email" required>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <div class="password-wrapper">
                    <input type="password" id="password" wire:model.blur="password" class="form-input"
                        placeholder="Enter your password" required>
                    <button type="button" class="toggle-password" id="togglePassword">
                        👁️
                    </button>
                    @error('password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-options">
                <div class="remember-me">
                    <input type="checkbox" wire:model="remember_me" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                </div>
                <a href="javascript:void(0)" wire:click="isForget" class="forgot-password">Forgot Password?</a>
            </div>

            <button type="submit" class="login-btn">Sign In
               
            </button>
            @if (Session::has('message'))
                <p class="alert-success ">{{ Session::get('message') }}</p>
            @endif
            @if (Session::has('error'))
                <p class="alert-danger ">{{ Session::get('error') }}</p>
            @endif
        </form>


    @endif


</div>
