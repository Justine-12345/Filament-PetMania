@extends('layouts.app')

@section('content')
    <div class=" md:pt-[20vh] md:flex md:justify-center pb-[20vh] ">
        <div class=" md:grid md:grid-cols-2 md:max-w-7xl ">

            <div>
                <img class=" h-[70vh] w-full md:h-auto  object-cover object-top filter brightness-95  "
                    src=" {{ $animal->getFirstMediaUrl('animals') }}" />
            </div>

            <div class=" px-[24px] ">

                <div class=" md:text-left py-7  text-3xl font-bold text-[#2E2E2E] w-full  text-center">

                    {{ $animal->name }}


                </div>


                <div
                    class="   text-white text-center items-center flex justify-center flex-col md:grid md:grid-cols-4 md:justify-items-center  ">
                    <div
                        class=" border-white  border-[5px] bg-[#FFA53B]  rounded-[100%] p-8  shadow-lg w-32 h-32 flex items-center justify-center flex-col  ">
                        <div class=" text-sm font-light ">
                            Category
                        </div>
                        <div class=" font-semibold text-xl truncate ">
                            {{ $animal->category->name }}
                        </div>
                    </div>
                    <div
                        class=" border-white  border-[5px] bg-[#FFA53B]  rounded-[100%] p-8  shadow-lg  w-32 h-32 flex items-center justify-center flex-col  ">
                        <div class=" text-sm font-light ">
                            Age
                        </div>
                        <div class=" font-semibold text-xl truncate ">
                            {{ $animal->age }}
                        </div>
                    </div>
                    <div
                        class=" border-white  border-[5px] bg-[#FFA53B]  rounded-[100%] p-8  shadow-lg w-32 h-32 flex items-center justify-center flex-col  ">
                        <div class=" text-sm font-light ">
                            Breed
                        </div>
                        <div class=" font-semibold text-xl truncate ">
                            {{ $animal->breed }}
                        </div>
                    </div>
                    <div
                        class=" border-white  border-[5px] bg-[#FFA53B]  rounded-[100%] p-8  shadow-lg w-32 h-32 flex items-center justify-center flex-col  ">
                        <div class=" text-sm font-light ">
                            Gender
                        </div>
                        <div class=" font-semibold text-xl truncate ">
                            {{ $animal->gender }}
                        </div>
                    </div>
                </div>
                <div class=" py-10 max-w-[100%]  prose   ">
                    {!! $animal->description !!}
                </div>
                @if ($animal->adoption_status == 'Unadopted')
                    <div class="flex justify-center md:justify-end md:my-4  ">
                        <form action="{{ route('animal.update', $animal->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="adoption_status" value="Pending" />
                            <input
                                class=" hover:shadow-xl my-0 w-fit bg-[#FFA53B] text-white py-2 px-6 shadow-lg cursor-pointer hover:scale-110 transition-all active:scale-100 "
                                type="submit" value="Adopt Me" />
                        </form>

                    </div>
                @endif

            </div>

        </div>
    </div>
@endsection
