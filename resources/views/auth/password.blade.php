@extends('layouts.app')

@section('content')
    <div class=" flex justify-center ">
        <form method="POST" action="{{ route('password') }}">
            @csrf
            <div
                class=" px-7 pt-[50px] pb-[30px] my-[145px] space-y-6 bg-[#FFA53B] max-w-4xl flex justify-center flex-col items-center ">

                @if (Session::get('error'))
                    <div class=" text-base font-normal text-center my-4 animate-pulse bg-red-500 py-2 w-full ">Wrong current
                        password</div>
                @endif

                <div class=" text-white text-4xl font-bold ">
                    Change Password
                </div>


                <div class="  w-full flex flex-col space-y-4 ">

                    <div class="">
                        <input type="password" name="old_password" placeholder="Current Password"
                            class=" border-0 text-slate-800 w-full " />
                        @error('old_password')
                            <label class=" text-sm animate-pulse ">*{{ $message }}</label>
                        @enderror
                    </div>

                    <div class="">
                        <input type="password" name="password" placeholder="New Password"
                            class=" border-0 text-slate-800 w-full" />
                        @error('password')
                            <label class=" text-sm animate-pulse ">*{{ $message }}</label>
                        @enderror
                    </div>

                    <div class="">
                        <input type="password" name="password_confirmation" placeholder="Confirm New Password"
                            class=" border-0 text-slate-800 w-full" />
                        @error('password_confirmation')
                            <label class=" text-sm animate-pulse ">*{{ $message }}</label>
                        @enderror
                    </div>

                </div>
                <div class=" pt-1  flex w-full justify-end     ">
                    <input
                        class=" w-full text-xs hover:scale-110 transition-all cursor-pointer active:scale-100 shadow hover:shadow-xl active:shadow px-8 py-2  h-full bg-white text-[#FFA53B] font-semibold "
                        type="submit" value="SAVE CHANGES">
                </div>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#fileInput').change(function() {
                var file = $(this)[0].files[0];
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#myImage').attr('src', e.target.result);
                    $('#myImage').attr('alt', file.name);
                }

                reader.readAsDataURL(file);
            });
        });
    </script>
@endsection
