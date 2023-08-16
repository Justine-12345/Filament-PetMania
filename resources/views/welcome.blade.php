@extends('layouts.app')

@section('content')
    <div>
        <div class=" ">
            <img class=" md:block hidden w-full h-full " src="{{ asset('storage/assets/cover.png') }}" />
            <img class=" md:hidden block w-full h-full " src="{{ asset('storage/assets/cover-mobile.png') }}" />
        </div>
        
        
        {{-- Adoptable --}}
        <div class=" py-[50px] px-10 ">
            <div>
                <div class=" text-3xl font-bold text-[#FFA53B] w-full  text-center ">
                    Adoptable Animals
                </div>

                <div class=" my-14 md:flex ">

                    {{-- Animal Card --}}

                    @foreach ($animals as $animal)
                        <div
                            class=" grow hover:shadow-xl hover:scale-110 transition-all active:scale-100 cursor-pointer my-4 m-auto  max-w-xs bg-[#FFA53B] text-white rounded-lg overflow-hidden shadow-md  ">
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
                <div class="flex justify-center  ">
                    <a href="{{route('animal.index')}}" >
                        <div
                            class="  hover:shadow-xl my-4 w-fit bg-[#FFA53B] text-white py-4 px-6 text-xl shadow-lg cursor-pointer hover:scale-110 transition-all active:scale-100 ">
                            See more
                        </div>
                    </a>
                </div>


            </div>
        </div>

        {{-- About --}}
        <div id="about" class=" relative py-[50px]  space-y-20 flex flex-col justify-center items-center ">
            <img class=" w-full absolute -z-10 opacity-20 h-full object-cover "
                src="{{ asset('storage/assets/1000_F_276090236_a2ng3Zxuf7079pAy9F8i6ld2bqCpGwKg.jpg') }}" />
            {{-- Content --}}
            <div class=" max-w-3xl md:max-w-7xl md:gap-4 m-auto md:grid md:grid-cols-2 mx-6  ">
                <div class=" flex justify-end ">
                    <img class=" w-full md:max-w-lg h-full object-cover "
                        src="{{ asset('storage/assets/smiling-veterinary-examining-dog-clinic-69542253.jpg') }}" />
                </div>
                <div>
                    <div class=" font-bold text-3xl text-[#373737] border-l-[7px] border-[#FFA53B] px-2 my-3">
                        Nurturing Paws <br />
                        Building Bonds
                    </div>
                    <div class=" md:max-w-lg md:text-left  text-[15px] font-light leading-9 ">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean volutpat, mi a dapibus eleifend,
                        neque mauris cursus nunc, vitae ornare orci lectus id tortor. Etiam a ultrices mi. Proin ac sagittis
                        arcu, vitae auctor est. Donec fermentum metus quis suscipit feugiat. Sed lobortis rhoncus enim, in
                        finibus nulla euismod non. Phasellus tempus condimentum lorem, id tincidunt massa laoreet id. Donec
                        orci tortor, accumsan ut pulvinar sed, pharetra venenatis massa. Nulla sed fringilla nunc, quis
                        pretium elit.
                    </div>
                </div>
            </div>


            {{-- Content --}}
            <div class="  md:grid-flow-row max-w-3xl md:max-w-7xl md:gap-4 m-auto md:grid md:grid-cols-2 mx-6  ">
                <div class=" flex justify-start order-2 ">
                    <img class=" w-full md:max-w-lg h-full object-cover "
                        src="{{ asset('storage/assets/istockphoto-1171733307-612x612.jpg') }}" />
                </div>
                <div class=" order-1  md:flex md:justify-end flex-col items-end ">
                    <div
                        class=" md:text-right text-left font-bold text-3xl text-[#373737] border-l-[7px] md:border-l-[0px] md:border-r-[7px] border-[#FFA53B] px-2 my-3">
                        Nurturing Paws <br />
                        Building Bonds
                    </div>
                    <div class=" md:max-w-lg md:text-right text-left  text-[15px] font-light leading-9 ">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean volutpat, mi a dapibus eleifend,
                        neque mauris cursus nunc, vitae ornare orci lectus id tortor. Etiam a ultrices mi. Proin ac sagittis
                        arcu, vitae auctor est. Donec fermentum metus quis suscipit feugiat. Sed lobortis rhoncus enim, in
                        finibus nulla euismod non. Phasellus tempus condimentum lorem, id tincidunt massa laoreet id. Donec
                        orci tortor, accumsan ut pulvinar sed, pharetra venenatis massa. Nulla sed fringilla nunc, quis
                        pretium elit.
                    </div>
                </div>
            </div>





        </div>


        {{-- Testimonial --}}
        <div class=" pt-[150px] pb-[50px] px-10 ">
            <div class=" text-3xl font-bold text-[#2E2E2E] w-full  text-center ">
                Testimonials
            </div>

            <div class=" my-8 md:grid md:grid-cols-3 ">

                <div class=" italic text-[#2C2C2C] max-w-sm m-auto text-center my-10 ">
                    <div class=" font-light ">
                        “Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean volutpat, mi a dapibus eleifend,
                        neque
                        mauris cursi.”
                    </div>
                    <div class=" font-semibold ">
                        -Lorem
                    </div>
                </div>

                <div class=" italic text-[#2C2C2C] max-w-sm m-auto text-center my-10 ">
                    <div class=" font-light ">
                        “Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean volutpat, mi a dapibus eleifend,
                        neque
                        mauris cursi.”
                    </div>
                    <div class=" font-semibold ">
                        -Lorem
                    </div>
                </div>

                <div class=" italic text-[#2C2C2C] max-w-sm m-auto text-center my-10 ">
                    <div class=" font-light ">
                        “Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean volutpat, mi a dapibus eleifend,
                        neque
                        mauris cursi.”
                    </div>
                    <div class=" font-semibold ">
                        -Lorem
                    </div>
                </div>

            </div>


        </div>


        {{-- Contact --}}
        <div id="contact" class=" py-[70px] bg-[#EBEBEB] px-10 ">
            <div class=" text-3xl font-bold text-[#2E2E2E] w-full  text-center mb-9 ">
                Contact Us
            </div>
            <div class=" md:grid md:grid-cols-2 gap-8 ">
                <div>

                    <div class=" space-y-8 ">
                        <input type="text" placeholder="Name" class=" border-0 w-full  ">
                        <input type="email" placeholder="Email" class=" border-0 w-full  ">
                        <input type="number" placeholder="Phone Number" class=" border-0 w-full  ">
                    </div>
                </div>
                <div>
                    <div class=" md:my-0 my-6">
                        <textarea placeholder=" Type your message here... " class=" w-full border-0 " rows="7"></textarea>
                    </div>
                    <div class="flex justify-center md:justify-end md:my-4  ">
                        <div
                            class=" hover:shadow-xl my-0 w-fit bg-[#FFA53B] text-white py-2 px-6 shadow-lg cursor-pointer hover:scale-110 transition-all active:scale-100 ">
                            Submit
                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>
@endsection
