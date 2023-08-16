<style>
    #alert-bar {
        display: none;

    }
</style>
<nav id="scrollDiv" class="
@if (Request::path() != 'register' && Request::path() != 'login') bg-[#FFA53B] @endif
  z-40 fixed top-0  w-full  ">
    {{-- {{dd(Auth::user())}} --}}
    <div class=" flex justify-between md:px-14 px-5 ">
        <div class="  md:py-4 ">
            <a href="/" class=" cursor-pointer ">
                <img class=" h-10 md:h-14 " src="{{ asset('storage/assets/logo.png') }}" />
            </a>
        </div>


        <div id="md-nav" class=" hidden md:flex mx-4 justify-center text-white items-center gap-4 font-semibold ">
            <a href="{{ route('home') }}">
                <div class=" w-full text-center py-2 ">
                    HOME
                </div>
            </a>
            <a href="{{ route('animal.index') }}">
                <div class=" w-full text-center py-2 ">
                    PETS
                </div>
            </a>
            <a href="/#about" >
                <div class=" w-full text-center py-2 ">
                    ABOUT
                </div>
            </a>
            <a href="/#contact" >
                <div class=" w-full text-center py-2 ">
                    CONTACT
                </div>
            </a>
            @if (Auth::user())
                <a class=" profile-pic overflow-hidden  transition-all rounded-[100%] cursor-pointer">
                    <div class=" h-[50px] w-[50px] shadow  text-center  overflow-hidden rounded-[100%] ">
                        <img class=" h-full w-full  object-cover "
                            src="{{Auth::user()->getFirstMediaUrl('avatars')}}" />
                    </div>
                </a>

                {{-- <a class="h-10 flex gap-3 items-center justify-center  " href="{{ route('logout') }}">
                    <div
                        class=" w-fit text-center py-2 bg-[#fff] px-4 text-[#FFA53B] cursor-pointer transition-all shadow active:scale-100 active:shadow hover:scale-110 hover:shadow-xl ">
                        LOG&nbsp;OUT
                    </div>
                </a> --}}
            @else
                <a href="{{ route('login') }}">
                    <div
                        class=" w-fit text-center py-2 bg-[#fff] px-4 text-[#FFA53B] cursor-pointer transition-all shadow active:scale-100 active:shadow hover:scale-110 hover:shadow-xl ">
                        SIGN&nbsp;IN
                    </div>
                </a>
            @endif
        </div>



        <div id="hamburger-nav"
            class=" cursor-pointer md:hidden flex  mx-4 justify-center text-white items-center gap-2 font-semibold ">
            <div class=" w-full text-center py-2 text-2xl ">
                <i class="bi bi-list"></i>
            </div>
        </div>
    </div>

    <div id="sm-nav"
        class=" md:hidden  flex justify-center flex-col items-center gap-2 font-semibold text-white bg-[#FFA53B] bg-opacity-70 backdrop-blur-xl shadow-lg">
        <a href="{{ route('home') }}" class=" w-full ">
            <div class=" cursor-pointer hover:bg-white transition-all hover:text-[#FFA53B] w-full text-center py-2 ">
                HOME
            </div>
        </a>

        <a href="{{ route('animal.index') }}" class=" w-full ">
            <div class=" cursor-pointer hover:bg-white transition-all hover:text-[#FFA53B] w-full text-center py-2 ">
                PETS
            </div>
        </a>

        <a href="" class=" w-full ">
            <div class=" cursor-pointer hover:bg-white transition-all hover:text-[#FFA53B] w-full text-center py-2 ">
                ABOUT
            </div>
        </a>

        <a href="" class=" w-full ">
            <div class=" cursor-pointer hover:bg-white transition-all hover:text-[#FFA53B] w-full text-center py-2 ">
                CONTACT
            </div>
        </a>

        @if (Auth::user())
        <a class="profile-pic w-full flex justify-center mb-4 ">
            <div
                class=" h-[50px] w-[50px] cursor-pointer transition-all  text-center rounded-full overflow-hidden ">
                <img class=" h-full w-full  object-cover "
                src="{{Auth::user()->getFirstMediaUrl('avatars')}}" />
            </div>
        </a>
        @else
            <a  href="{{ route('login') }}" class=" w-full ">
                <div
                    class=" cursor-pointer hover:bg-white transition-all hover:text-[#FFA53B] w-full text-center py-2 ">
                    SIGN IN
                </div>
            </a>
        @endif


    </div>

</nav>
@if (Auth::user())
    <div id="profile-nav"
        class="hidden rounded-xl overflow-hidden p-4  space-y-4 right-0 md:right-14 md:top-24 md:w-fit top-80 w-full z-50 fixed text-white bg-[#FFA53B] bg-opacity-70 backdrop-blur-xl shadow-lg  ">
        <a href="{{route('getProfile')}}" >
            <div class="  cursor-pointer hover:bg-white transition-all hover:text-[#FFA53B] w-full py-1 px-2  ">
                <i class="bi bi-person-fill"></i> &nbsp; Profile
            </div>
        </a>
        <a href="{{route('getPassword')}}" >
            <div class="cursor-pointer hover:bg-white transition-all hover:text-[#FFA53B] w-full py-1  px-2 ">
                <i class="bi bi-key-fill"></i> &nbsp; Password
            </div>
        </a>
        <a href="{{ route('logout') }}">
            <div class="cursor-pointer hover:bg-white transition-all hover:text-[#FFA53B] w-full py-1 px-2 ">
                <i class="bi bi-door-open-fill"></i> &nbsp; Logout
            </div>
        </a>
    </div>
@endif

@if (Session::get('status'))
    <div id="alert-bar" class=" fixed top-28 z-50 w-full flex justify-center  ">
        <div class=" shadow-xl w-fit m-auto   flex items-center bg-green-500 text-white text-sm font-bold px-4 py-3"
            role="alert">
            <i class="bi bi-check-circle-fill"></i> &nbsp;
            <p>{{ Session::get('status') }}</p>
        </div>

    </div>
@endif



<script>
    window.addEventListener('scroll', function() {
        const scrollDiv = document.getElementById('scrollDiv');
        if (window.scrollY > 0) {
            scrollDiv.classList.add('bg-[#FFA53B]');
            scrollDiv.classList.add('bg-opacity-70');
            scrollDiv.classList.add('backdrop-blur-xl');
            scrollDiv.classList.add('shadow-lg');
        }

        if (window.scrollY < 1) {
            // scrollDiv.classList.remove('bg-[#FFA53B]');
            scrollDiv.classList.remove('bg-opacity-70');
            scrollDiv.classList.remove('backdrop-blur-xl');
            scrollDiv.classList.remove('shadow-lg');
        }
    });

    $(document).ready(function() {
        var isOpenNav = false;
        var isOpenProfileNav = false
        $('#sm-nav').hide();
        $("#hamburger-nav").click(function(e) {

            if (isOpenNav == false) {
                isOpenNav = true
                $('#sm-nav').show('1000');
            } else {
                isOpenNav = false
                isOpenProfileNav = false
                $('#sm-nav').hide('300');
                $('#profile-nav').hide();
            }


        });


        $(".profile-pic").click(function(e) {

            if (isOpenProfileNav == false) {
                isOpenProfileNav = true
                $('#profile-nav').show('1000');
            } else {
                isOpenProfileNav = false
                $('#profile-nav').hide('300');
            }


        });

        $(document).ready(function() {
            $("#alert-bar").fadeIn(300, function() {
                $(this).delay(2000).fadeOut(300);
            });
        });


    });
</script>
