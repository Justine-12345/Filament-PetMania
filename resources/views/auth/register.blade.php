@extends('layouts.app')

@section('content')
    <div class=" h-[100vh] overflow-hidden relative ">
        <img class=" object-center absolute  h-[100vh] w-full object-cover brightness-75 "
            src="{{ asset('storage/assets/girl-oversize-shirt-laughs-wholeheartedly-looks-her-dark-haired-man-holding-labrador.jpg') }}" />
        <div class=" flex absolute  w-full h-[100vh] justify-end items-center px-14   ">
            <div class=" h-fit mx-4 bg-[#ff8f0f] bg-opacity-60 shadow-2xl backdrop-blur-lg text-white space-y-7 w-[100%] md:w-[30%] px-10 py-12 ">
                <div class=" text-4xl font-bold ">
                    Register
                </div>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class=" space-y-8 ">
                        <div class="">
                            <input type="text" name="name" placeholder="Name" value="{{ old('name') }}"
                                class=" border-0 text-slate-800 w-full " />
                            @error('name')
                                <label class=" text-sm animate-pulse ">*{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="">
                            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                                class=" border-0 text-slate-800 w-full" />
                            @error('email')
                                <label class=" text-sm animate-pulse ">*{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="">
                            <input type="password" name="password" placeholder="Password"
                                class=" border-0 text-slate-800 w-full" />
                            @error('password')
                                <label class=" text-sm animate-pulse ">*{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="">
                            <input type="password" name="password_confirmation" placeholder="Confirm Password"
                                class=" border-0 text-slate-800 w-full " />
                            @error('password_confirmation')
                                <label class=" text-sm animate-pulse ">*{{ $message }}</label>
                            @enderror
                        </div>
                       
                        <div class="  flex items-center w-full justify-center    ">
                            <input
                                class=" hover:scale-110 transition-all cursor-pointer active:scale-100 shadow hover:shadow-xl active:shadow px-12 py-2  h-full bg-white text-[#FFA53B] font-semibold "
                                type="submit" value="SIGN UP">
                        </div>
                    </div>
                    <div  class=" flex justify-center my-3 ">
                        <a href="{{route('login')}}" >Login</a>
                   </div>
                </form>
               
              
            </div>

        </div>
    </div>
@endsection
