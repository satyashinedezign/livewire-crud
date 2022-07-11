<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Posts</h4>
                            <div class="card-header-form">
                                @if (!$hidePosts)
                                    <button wire:click="add" class="btn btn-primary">Add Post</button>
                                @else
                                    <button wire:click="allPosts" class="btn btn-primary">All Post</button>
                                @endif
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive {{ $hidePosts ? 'hidden' : ''}}">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($posts as $sno => $post)
                                            <tr>
                                                <th scope="row">{{ ++$sno }}</th>
                                                <td>{{ $post->title }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="add-post {{ !$hidePosts ? 'hidden' : ''}}">
                                <div class="md:col-span-1 flex justify-between">
                                    <div class="px-4 sm:px-0">
                                        <h3 class="text-lg font-medium text-gray-900">Add Post</h3>
                                    </div>
                                </div>

                                <div class="mt-5 md:mt-0 md:col-span-2">
                                    <form wire:submit.prevent="store">
                                        <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                                            <div class="grid grid-cols-6 gap-6">
                                                <!-- Title -->
                                                <div class="col-span-6 sm:col-span-4">
                                                    <label for="title" class="block font-medium text-sm text-gray-700">
                                                        {{ __('Title') }}
                                                    </label>
                                                    <input id="title" type="text" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" wire:model.defer="state.title" autocomplete="title" />
                                                    @error('title')
                                                        <p for="title" class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-span-6 sm:col-span-4">
                                                    <label for="title" class="block font-medium text-sm text-gray-700">
                                                        {{ __('Title') }}
                                                    </label>
                                                    <input id="title" type="text" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" wire:model.defer="state.title" autocomplete="title" />
                                                    @error('title')
                                                        <p for="title" class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-6 gap-6 mt-5">
                                                <!-- Title -->
                                                <div class="col-span-6 sm:col-span-4">
                                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                                                        Save
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
