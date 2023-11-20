@extends('layouts.app')

@section('main')

    <select-level></select-level>
{{--    <div class="min-h-full bg-space flex justify-center items-center">--}}
{{--        <div class="container mx-auto rounded-md fixed top-0">--}}
{{--            <div class="font-bold text-xl bg-stone-600 px-5 py-5 mx-5 shadow-2xl rounded-b-lg text-gray-300">--}}
{{--                Experiencias logico matematicas--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="container mx-auto mb-10 rounded-md px-5 py-5">--}}
{{--            <div class=" flex-col pt-5 rounded-md shadow-2xl">--}}
{{--                <div--}}
{{--                    class="flex justify-center grid md:grid-cols-3 sm:grid-cols-1 mx-5">--}}
{{--                    <div class="flex md:justify-end justify-center">--}}
{{--                        --}}{{--                        <div class="w-20">--}}
{{--                        --}}{{--                            <mati-saludo asset="{{asset('images')}}"></mati-saludo>--}}
{{--                        --}}{{--                        </div>--}}
{{--                    </div>--}}

{{--                    --}}{{--                    <div style="background-image: url('https://cdn.pixabay.com/photo/2019/11/07/17/07/universe-4609408_1280.jpg'); background-size: 900px;"--}}
{{--                    --}}{{--                        class="md:flex sm:flex-col items-center bg-gray-800 text-gray-200 rounded-md border-gray-700 border-4">--}}
{{--                    --}}{{--                        <div class="flex justify-center">--}}
{{--                    --}}{{--                            <div>Salva los &nbsp</div>--}}
{{--                    --}}{{--                        </div>--}}
{{--                    --}}{{--                        <div class="flex justify-center pl-3">--}}
{{--                    --}}{{--                            <div class="spinner">--}}
{{--                    --}}{{--                                <span class="text-blue-600">C</span>--}}
{{--                    --}}{{--                                <span class="text-red-600">O</span>--}}
{{--                    --}}{{--                                <span class="text-yellow-400">L</span>--}}
{{--                    --}}{{--                                <span class="text-green-600">O</span>--}}
{{--                    --}}{{--                                <span class="text-blue-600">R</span>--}}
{{--                    --}}{{--                                <span class="text-red-600">E</span>--}}
{{--                    --}}{{--                                <span class="text-yellow-400">S</span>--}}
{{--                    --}}{{--                            </div>--}}
{{--                    --}}{{--                        </div>--}}
{{--                    --}}{{--                        <div class="flex justify-center">--}}
{{--                    --}}{{--                            <div>--}}
{{--                    --}}{{--                                <span>con&nbsp</span>--}}
{{--                    --}}{{--                                <span class="text-red-600 font-bold">Mati&nbsp</span>--}}
{{--                    --}}{{--                                <span>y&nbsp</span>--}}
{{--                    --}}{{--                                <span class="text-blue-600 font-bold">Motas&nbsp</span>--}}
{{--                    --}}{{--                            </div>--}}
{{--                    --}}{{--                        </div>--}}
{{--                    --}}{{--                    </div>--}}

{{--                    --}}
{{--                    <div class="flex md:justify-start justify-center">--}}
{{--                        --}}{{--                        <div class="w-20">--}}
{{--                        --}}{{--                            <mati-saludo asset="{{asset('images')}}"></mati-saludo>--}}
{{--                        --}}{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="flex justify-center mt-5">--}}
{{--                    <div class="font-bold text-2xl text-gray-200">Niveles</div>--}}
{{--                </div>--}}

{{--                <div class="mt-5 gap-5 grid grid-cols-6  mx-5">--}}

{{--                    <a href="{{asset('level1/1')}}">--}}
{{--                        <div--}}
{{--                            style="background-image: url('https://cdn.pixabay.com/photo/2022/05/12/16/04/trees-7191822_1280.png'); background-size: 170px"--}}
{{--                            class="bg-blue-300 p-5 rounded-md shadow-2xl border-blue-400 border-4 flex justify-center hover:scale-90 duration-300 cursor-pointer">--}}
{{--                            <div>Nivel 1</div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a href="{{ asset('level2/1') }}">--}}
{{--                        <div--}}
{{--                            style="background-image: url('https://cdn.pixabay.com/photo/2020/02/16/05/59/alien-4852662_1280.jpg'); background-size: 220px"--}}
{{--                            class="bg-orange-300 p-5 rounded-md shadow-2xl border-orange-400 border-4 flex justify-center hover:scale-90 duration-300 cursor-pointer">--}}
{{--                            <div>Nivel 2</div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a href="{{ asset('level3/1') }}">--}}
{{--                        <div--}}
{{--                            style="background-image: url('https://cdn.pixabay.com/photo/2018/04/21/01/36/green-3337499_1280.png'); background-size: 220px"--}}
{{--                            class="bg-green-300 p-5 rounded-md shadow-2xl border-green-400 border-4 flex justify-center hover:scale-90 duration-300 cursor-pointer">--}}
{{--                            <div>Nivel 3</div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a href="{{ asset('level4/1') }}">--}}
{{--                        <div--}}
{{--                            style="background-image: url('https://cdn.pixabay.com/photo/2021/07/15/05/06/flowers-6467492_1280.jpg'); background-size: 220px"--}}
{{--                            class="bg-rose-300 p-5 rounded-md shadow-2xl border-rose-400 border-4 flex justify-center hover:scale-90 duration-300 cursor-pointer">--}}
{{--                            <div>Nivel 4</div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a href="{{ asset('level5/1') }}">--}}
{{--                        <div--}}
{{--                            style="background-image: url('https://cdn.pixabay.com/photo/2016/11/21/03/56/landscape-1844230_1280.png'); background-size: 220px"--}}
{{--                            class="bg-red-300 p-5 rounded-md shadow-2xl border-red-400 border-4 flex justify-center hover:scale-90 duration-300 cursor-pointer">--}}
{{--                            <div>Nivel 5</div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a href="{{ asset('level6/1') }}">--}}
{{--                        <div--}}
{{--                            style="background-image: url('https://cdn.pixabay.com/photo/2012/08/27/14/19/mountains-55067_1280.png'); background-size: 240px"--}}
{{--                            class="bg-yellow-300 p-5 rounded-md shadow-2xl border-yellow-400 border-4 flex justify-center hover:scale-90 duration-300 cursor-pointer">--}}
{{--                            <div>Nivel 6</div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a href="{{ asset('level7/1') }}">--}}
{{--                        <div--}}
{{--                            style="background-image: url('https://cdn.pixabay.com/photo/2019/12/17/12/00/cave-4701500_1280.png'); background-size: 240px"--}}
{{--                            class="bg-stone-400 p-5 rounded-md shadow-2xl border-stone-500 border-4 flex justify-center hover:scale-90 duration-300 cursor-pointer text-gray-300">--}}
{{--                            <div>Nivel 7</div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a href="{{ asset('level8/1') }}">--}}
{{--                        <div--}}
{{--                            style="background-image: url('https://cdn.pixabay.com/photo/2017/04/23/14/23/mountains-2253940_1280.jpg'); background-size: 240px"--}}
{{--                            class="bg-pink-300 p-5 rounded-md shadow-2xl border-pink-400 border-4 flex justify-center hover:scale-90 duration-300 cursor-pointer">--}}
{{--                            <div>Nivel 8</div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a href="{{ asset('level9/1') }}">--}}
{{--                        <div--}}
{{--                            style="background-image: url('https://cdn.pixabay.com/photo/2022/07/19/10/15/sea-7331682_1280.jpg'); background-size: 240px"--}}
{{--                            class="bg-rose-200 p-5 rounded-md shadow-2xl border-rose-300 border-4 flex justify-center hover:scale-90 duration-300 cursor-pointer">--}}
{{--                            <div>Nivel 9</div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a href="{{ asset('level10/1') }}">--}}
{{--                        <div--}}
{{--                            style="background-image: url('https://cdn.pixabay.com/photo/2016/11/21/03/56/landscape-1844226_1280.png'); background-size: 240px"--}}
{{--                            class="bg-blue-600 p-5 rounded-md shadow-2xl border-blue-700 border-4 flex justify-center hover:scale-90 duration-300 cursor-pointer">--}}
{{--                            <div>Nivel 10</div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a href="{{ asset('level11/1') }}">--}}
{{--                        <div--}}
{{--                            style="background-image: url('https://cdn.pixabay.com/photo/2020/04/30/10/08/desert-5112222_1280.png'); background-size: 240px"--}}
{{--                            class="bg-yellow-200 p-5 rounded-md shadow-2xl border-yellow-400 border-4 flex justify-center hover:scale-90 duration-300 cursor-pointer">--}}
{{--                            <div>Nivel 11</div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a href="{{  asset('level12/1') }}">--}}
{{--                        <div--}}
{{--                            style="background-image: url('https://cdn.pixabay.com/photo/2014/03/23/00/22/the-background-293017_1280.png'); background-size: 240px"--}}
{{--                            class="bg-red-600 p-5 rounded-md shadow-2xl border-red-700 border-4 flex justify-center hover:scale-90 duration-300 cursor-pointer">--}}
{{--                            <div>Nivel 12</div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a href="{{  asset('level13/1')  }}">--}}
{{--                        <div--}}
{{--                            style="background-image: url('https://cdn.pixabay.com/photo/2017/01/31/13/36/landscape-2024099_1280.png'); background-size: 240px"--}}
{{--                            class="bg-red-100 p-5 rounded-md shadow-2xl border-red-200 border-4 flex justify-center hover:scale-90 duration-300 cursor-pointer">--}}
{{--                            <div>Nivel 13</div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a href="{{ asset('level14/1') }}">--}}
{{--                        <div--}}
{{--                            style="background-image: url('https://cdn.pixabay.com/photo/2019/10/13/19/45/boat-4547083_640.png'); background-size: 240px"--}}
{{--                            class="bg-green-600 p-5 rounded-md shadow-2xl border-green-700 border-4 flex justify-center hover:scale-90 duration-300 cursor-pointer">--}}
{{--                            <div>Nivel 14</div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a href="{{  asset('level15/1')  }}">--}}
{{--                        <div--}}
{{--                            style="background-image: url('https://cdn.pixabay.com/photo/2017/08/06/11/29/the-desert-2591554_1280.png'); background-size: 240px"--}}
{{--                            class="bg-yellow-400 p-5 rounded-md shadow-2xl border-yellow-500 border-4 flex justify-center hover:scale-90 duration-300 cursor-pointer">--}}
{{--                            <div>Nivel 15</div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a href="{{ asset('level16/1')}}">--}}
{{--                        <div--}}
{{--                            style="background-image: url('https://cdn.pixabay.com/photo/2019/11/27/19/03/landscape-4657646_640.jpg'); background-size: 240px"--}}
{{--                            class="bg-pink-600 p-5 rounded-md shadow-2xl border-pink-700 border-4 flex justify-center hover:scale-90 duration-300 cursor-pointer">--}}
{{--                            <div>Nivel 16</div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a href="{{ asset('level17/1') }}">--}}
{{--                        <div--}}
{{--                            style="background-image: url('https://cdn.pixabay.com/photo/2017/04/24/09/25/horse-2255876_1280.jpg'); background-size: 170px"--}}
{{--                            class="bg-orange-300 p-5 rounded-md shadow-2xl border-orange-400 border-4 flex justify-center hover:scale-90 duration-300 cursor-pointer">--}}
{{--                            <div>Nivel 17</div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a href="{{ asset('level18/1') }}">--}}
{{--                        <div--}}
{{--                            style="background-image: url('https://cdn.pixabay.com/photo/2017/04/24/15/25/robot-2256814_1280.jpg'); background-size: 215px"--}}
{{--                            class="bg-teal-800 p-5 rounded-md shadow-2xl border-teal-900 border-4 flex justify-center hover:scale-90 duration-300 cursor-pointer">--}}
{{--                            <div>Nivel 18</div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </div>--}}

{{--                <div class="p-5">--}}
{{--                    <a href="">--}}
{{--                        <button--}}
{{--                            class="bg-red-300 px-2 py-1 rounded-md border-red-800 border-2 flex items-center hover:text-white hover:bg-gray-700 hover:scale-90 duration-300">--}}
{{--                            <home-icon class="h-7 w-7"></home-icon>--}}
{{--                            <span class="font-bold">&nbspVolver</span>--}}
{{--                        </button>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}


{{--            --}}{{--            <a href="">--}}
{{--            --}}{{--                <div--}}
{{--            --}}{{--                    class="bg-blue-600 p-10 rounded-lg hover:opacity-90 hover:scale-105 duration-300  hover:cursor-pointer flex justify-center">--}}
{{--            --}}{{--                    <span class="font-bold text-xl">Nivel 1</span>--}}
{{--            --}}{{--                </div>--}}
{{--            --}}{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
