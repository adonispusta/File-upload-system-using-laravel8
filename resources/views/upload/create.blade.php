<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload File') }}
        </h2>
    </x-slot>
    <style>
        .checkbox-round {
            width: 1.3em;
            height: 1.3em;
            background-color: white;
            border-radius: 50%;
            vertical-align: middle;
            border: 1px solid #ddd;
            -webkit-appearance: none;
            outline: none;
            cursor: pointer;
        }

        @media (max-width: 700px) {

            form {
                padding-right: 20px;
                padding-left: 20px;
            }

            button {
                margin: 15px auto !important;
            }

        }

    </style>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10">


        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

            @if ($errors->any())
                <div class="bg-red-300 mt-3 border-l-4 border-red-500 text-orange-700 p-4" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-red-900">{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="bg-green-300 mt-3 border-l-4 border-green-500 p-4" role="alert">
                    <p class="text-green-900">File Uploaded Successfully</p>
                </div>
            @endif
            @if (session('fileAlreadyExists'))
                <div class="bg-yellow-300 mt-3 border-l-4 border-yellow-500 p-4" role="alert">
                    <p class="text-yellow-900">{{session('fileAlreadyExists')}}</p>
                </div>
            @endif

            <form class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 pb-0" enctype="multipart/form-data" method="post"
                  action="{{route('file.store')}}">

                @CSRF
                <div class="border-2 border-dashed border-gray-300 relative sm:rounded-lg">
                    <input type="file" name="file"
                           class="cursor-pointer relative block opacity-0 w-full h-full p-20 z-50">
                    <div class="text-gray-500 text-center p-10 absolute top-0 right-0 left-0 m-auto">
                        <h4>
                            {{ __('Drop files anywhere to upload') }}

                            <br/>{{ __('or') }}
                        </h4>
                        <p class="">{{ __('Select Files') }}</p>
                    </div>
                    <label class="block text-gray-500 font-bold" for="remember">
                        <input class="ml-2 mb-2 leading-tight checkbox-round" type="checkbox" id="is-private"
                               name="is-private">
                        <span class="text-sm mb-2">
                                           {{ __('Set this file as a private file') }}
                                        </span>
                    </label>
                </div>
                <button type="submit" style="width:110px;text-align: left; margin:15px 0 "
                        class="flex mt-2 bg-blue-500 rounded-full font-bold text-white px-4 py-4 transition duration-300 ease-in-out hover:bg-blue-600 mr-6">{{__('Upload')}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline w-6 stroke-current text-white stroke-2"
                         viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"/>
                        <polyline points="12 5 19 12 12 19"/>
                    </svg>
                </button>


            </form>
        </div>
    </div>
</x-app-layout>