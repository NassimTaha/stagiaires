<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="form-box" >
    <form method="POST" action="{{ route('login') }}" >
        @csrf

        <!-- Email Address -->
        <div class="inputbox" style="margin-top: -8px;">          
            <input type="email" id="email" name="email" required autocomplete="off">
            <label for="">Email</label>
            
        </div>
        {{--<div>
            <div class="inputbox">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>--}}

        <!-- Password -->

        <div class="inputbox">        
            <input  type="password" id ="password" name="password" autocomplete="current-password" required>
            <label for="">Mot de passe</label>
            
        </div>
        <x-input-error :messages="$errors->get('email')" class="mt-1" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
      
        {{--<div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>--}}

        

        <!-- 
        @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        -->

        <div class="flex items-center justify-end mt-4">
            

            <x-primary-button class="mt-2 button"  style="width: 310px; justify-content: center; ">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</div>
</x-guest-layout>
<style>
    .form-box{
        position: relative;
        background: transparent;
        height: 290px;
        width: 400px;
        border: 2px solid black;
        border-radius: 20px;
        backdrop-filter: blur(15px);
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .inputbox{
    position: relative;
    margin: 30px 0;
    width: 310px;
    border-bottom: 2px solid black;
    }
        input:focus ~ label,
        input:valid ~ label{
        top: -5px;
        }
    .inputbox label {
            position: absolute;
            top: 50%;
            left: 5px;
            transform: translateY(-10%);
            color: black;
            font-size: 1em;
            pointer-events: none;
            transition: .5s;
            width: 100%;
            height: 50px;
            background: transparent;
            border: none;
            outline: none;
            font-size: 1em;
            padding:0 35px 0 5px;
            color:black;
        }
    .inputbox input {
            width: 100%;
            height: 50px;
            background: transparent;
            border: none;
            outline: none;
            font-size: 1em;
            padding:0 35px 0 5px;
            color: black;
    }
    .button{
    width: 100%;
    height: 40px;
    border-radius: 40px;
    border: none;
    outline: none;
}
</style>