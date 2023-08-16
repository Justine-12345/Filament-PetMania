@extends('layouts.app')

@section('content')
    <div class=" md:flex  ">
        <div class=" flex justify-center md:mx-6 ">
            <form method="POST" action="{{ route('profile') }}" enctype="multipart/form-data">
                @csrf
                <div
                    class=" px-7 pt-[50px] pb-[30px] mt-[145px] mb-[50px]  space-y-6 bg-[#FFA53B] w-96 flex justify-center flex-col items-center ">
                    <div class=" text-white text-4xl font-bold ">
                        Profile
                    </div>
                    <div class=" relative  ">
                        <div class=" flex justify-center ">
                            <div class=" h-52 w-52 rounded-[100%] overflow-hidden ">

                                <img for="fileInput" id="myImage" class=" shadow-md h-full w-full object-cover "
                                    src="{{ $user->getFirstMediaUrl('avatars') }}" />

                            </div>
                        </div>
                        <div
                            class=" opacity-70 transition-all hover:opacity-100 cursor-pointer absolute bottom-3 right-3 bg-black bg-opacity-80  rounded-[100%] h-10 w-10 flex justify-center items-center ">
                            <label>
                                <input class=" hidden w-0 h-0" name="image" type="file" id="fileInput">
                                <i class="bi cursor-pointer bi-camera-fill text-white text-xl  "></i>
                            </label>
                        </div>
                    </div>


                    <div class="  w-full flex flex-col space-y-4 ">
                        <div class="">
                            <input type="text" name="name" placeholder="Name" value="{{ old('name', $user->name) }}"
                                class=" border-0 text-slate-800 w-full " />
                            @error('name')
                                <label class=" text-sm animate-pulse ">*{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="">
                            <input type="email" name="email" placeholder="Email"
                                value="{{ old('email', $user->email) }}" class=" border-0 text-slate-800 w-full" />
                            @error('email')
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

        <div class="grow">
            <div class=" md:mt-[120px] w-fit font-bold text-3xl font-sans tracking-wider text-[#FFA53B] m-auto  ">
                Adopted Animals
            </div>

            <div class=" pb-[20vh]  px-[50px] flex justify-center">
                <div>

                    @if (count($user->adopted) <= 0)
                        <div class=" flex justify-center text-[#FFA53B] text-2xl font-bold ">
                            <div>
                                No result found <br />
                                <div class=" text-center my-4 text-7xl ">
                                    <i class="bi bi-question-circle-fill"></i>
                                </div>
                            </div>
                        </div>
                    @endif


                    <div class=" my-14  md:flex md:flex-wrap  gap-5 ">

                        {{-- Animal Card --}}

                        @foreach ($user->adopted as $animal)
                            <div
                                class=" md:min-w-[150px] md:w-[250px] hover:shadow-xl hover:scale-110 transition-all active:scale-100 cursor-pointer my-4 m-auto  bg-[#FFA53B] text-white rounded-lg overflow-hidden shadow-md  ">
                                <a href="{{ route('animal.show', $animal->id) }}">
                                    <div class=" relative ">
                                        <img class=" object-cover object-top w-full h-64 "
                                            src="{{ $animal->getFirstMediaUrl('animals') }}" />
                                        @if ($animal->adoption_status == 'Pending')
                                            <div class=" absolute bottom-0 bg-gray-400 w-full px-2 ">
                                                Adoption {{ $animal->adoption_status }} ...
                                            </div>
                                        @else
                                            <div class=" absolute bottom-0 bg-green-400 w-full px-2 ">
                                                <i class=" text-sm bi bi-check-circle-fill"></i> Adopted
                                            </div>
                                        @endif


                                    </div>
                                    <div class=" py-2 px-4 ">
                                        <div class=" ">
                                            <div class=" flex justify-between ">
                                                <div class=" font-semibold text-xl ">
                                                    {{ $animal->name }}
                                                    @if ($animal->gender == 'Male')
                                                        <i class="bi bi-gender-male"></i>
                                                    @elseif($animal->gender == 'Female')
                                                        <i class="bi bi-gender-female"></i>
                                                    @endif

                                                </div>
                                                <div class=" text-2xl ">
                                                    <i class="bi bi-heart"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" font-normal text-sm  relative  ">
                                            {{ $animal->age }} yrs old ({{ $animal->breed }})
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>

            </div>
        </div>
    </div>
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
