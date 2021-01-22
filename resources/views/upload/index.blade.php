<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Uploaded Files') }}
        </h2>
    </x-slot>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10">


        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">


            @if (session('success'))
                <div class="bg-green-300 mt-3 border-l-4 border-green-500 p-4" role="alert">
                    <p class="text-green-900">File Uploaded Successfully</p>
                </div>
            @endif

            <table class="w-full text-md bg-white rounded">
                <tbody>
                <tr class="border-b">
                    <th class="text-left p-3 px-5">Name</th>
                    <th class="text-left p-3 px-5">Type</th>
                    <th class="text-left p-3 px-5">Size</th>
                    <th class="text-left p-3 px-5">Access level</th>
                    <th></th>
                </tr>
                @foreach($files as $file)
                    <tr class="border-b hover:bg-orange-100 bg-gray-100">
                        <td class="p-3 px-5">{{$file->name}}</td>
                        <td class="p-3 px-5">{{$file->type}}</td>
                        <td class="p-3 px-5">{{number_format($file->size / (1024 * 1024),2)}} MB</td>
                        @if($file->is_private)
                            <td class="p-3 px-5">private</td>
                        @else
                            <td class="p-3 px-5">public</td>
                        @endif
                        <td class="p-3 px-5 flex justify-end">
                            <a type="button" href="{{route('file.show' , $file->id)}}"
                                    class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                                Download
                            </a>
                            <a type="button" href="{{route('file.delete' , $file->id)}}"
                                    class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                                Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>


        </div>
    </div>
</x-app-layout>