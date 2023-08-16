@extends('layouts.app')

@section('content')
    <div>
        <form action="{{ route('animal.index') }}" method="GET">
            @csrf
            <div class=" h-16 bg-[#FFA53B] ">

            </div>
            <div class=" relative ">
                <img class=" md:block hidden w-[100vw] h-[75vh] object-cover "
                    src="{{ asset('storage/assets/adoptableCover.png') }}" />
                <img class=" md:hidden block  w-[100vw] h-full   "
                    src="{{ asset('storage/assets/adoptableCover-mobile.png') }}" />

                <div class=" absolute top-[14vh] md:ml-[9vw] text-white  space-y-4 mx-4  ">
                    <div class=" font-bold text-5xl font-sans tracking-wider ">
                        Adoptable Animals
                    </div>
                    <div class=" space-y-2 ">
                        <div class=" flex justify-between gap-2 ">
                            <div class=" grow ">
                                <input name="name" value="" class=" w-full border-0 text-slate-800 "
                                    type="text">
                            </div>
                            <div class="  flex items-center    ">
                                <input class=" px-3  h-full bg-white text-[#FFA53B] font-semibold " type="submit"
                                    value="Search">
                            </div>
                        </div>
                        <div class=" flex  ">

                            <div class="grow md:flex gap-1">
                                <div class=" md:w-32 flex gap-1  ">
                                    <div>
                                        <label class=" text-xs ">Min. Age</label>
                                        <input name="min_age" type="number" class=" text-slate-800 w-full border-0 ">
                                    </div>
                                    <div>
                                        <label class=" text-xs ">Min. Age</label>
                                        <input name="max_age" type="number" class=" text-slate-800 w-full border-0 ">
                                    </div>
                                </div>
                                <div class=" grow ">
                                    <div>
                                        <label class=" text-xs ">Gender</label>
                                        <select name="gender" class="border-0 text-slate-800 w-full ">
                                            <option value=""></option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class=" grow ">
                                    <div>
                                        <label class=" text-xs ">Category</label>
                                        <select name="category_id" class="border-0 text-slate-800 w-full ">
                                            <option value=""></option>
                                            @foreach ($categories as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
        {{-- Adoptable --}}
        <div class=" pb-[20vh] pt-[10vh] px-[50px] ">
            <div>

                @if ( count($animals) <= 0 )
                <div class=" flex justify-center text-[#FFA53B] text-2xl font-bold " >
                    <div>
                        No result found <br/>
                        <div class=" text-center my-4 text-7xl " >
                            <i class="bi bi-question-circle-fill"></i>
                        </div>
                    </div>
                </div>
                @endif
              

                <div class=" my-14  md:grid md:grid-cols-3 gap-20 ">

                    {{-- Animal Card --}}

                    @foreach ($animals as $animal)
                        <div
                            class="  hover:shadow-xl hover:scale-110 transition-all active:scale-100 cursor-pointer my-4 m-auto w-full  bg-[#FFA53B] text-white rounded-lg overflow-hidden shadow-md  ">
                            <a href="{{ route('animal.show', $animal->id) }}">
                                <div class=" relative ">
                                    <img class=" object-cover object-top w-full h-64 "
                                        src="{{ $animal->getFirstMediaUrl('animals') }}" />
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
@endsection
