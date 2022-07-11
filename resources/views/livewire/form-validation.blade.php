<div class="container">
    <main class="{{ $showForm ? 'show' : 'd-none' }}">
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="{{ asset('images/bootstrap-logo.svg') }}" alt="" width="72" height="57">
            <h2>Create Form</h2>
            <p class="lead">You can create the bootstrap form for your application with frontend and backend validation. Frontend validation will use the jQuery validation plugin.</p>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        <div class="row g-5">
            <div class="col-md-12 col-lg-12 border shadow p-3 mb-5 bg-white rounded">
                <h4 class="mb-3">Form Info</h4>
                <form>
                    <div class="form-info">
                        <div class="row g-3">
                            <div class="col-sm-4">
                                <label for="form" class="form-label">Form ID</label>
                                <input type="text" class="form-control" placeholder="userForm" wire:model.lazy="formId">
                                @error('formId') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-sm-4">
                                <label for="method" class="form-label">Method</label>
                                <select class="form-select" wire:model.lazy="method">
                                    <option value="get">Get</option>
                                    <option value="post">Post</option>
                                </select>
                                @error('method') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-sm-4">
                                <label for="enctype" class="form-label">Enctype</label>
                                <select class="form-select" wire:model.lazy="enctype">
                                    <option value="">Select...</option>
                                    <option value="multipart/form-data">multipart/form-data</option>
                                    <option value="application/x-www-form-urlencoded">application/x-www-form-urlencoded</option>
                                    <option value="text/plain">text/plain</option>
                                </select>
                                @error('enctype') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-fields">
                        <hr class="my-4">
                        <h4 class="mb-3">Form Fields</h4>
                        @foreach($fields as $key => $value)
                            <div class="added-fields mb-3 border p-2 shadow p-3 mb-5 bg-white rounded">
                                <button class="bg-danger border-0 rounded-circle p-2 text-white float-end" wire:click.prevent="remove({{ $key }})"><i class="fa-solid fa-trash-can"></i></button>
                                <div class="row g-3">
                                    <div class="col-sm-4">
                                        <label for="label" class="form-label">Label</label>
                                        <input type="text" class="form-control" placeholder="label" wire:model.lazy="label.{{ $value }}">
                                        @error('label.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="fieldtype" class="form-label">Field Type</label>
                                        <select class="form-select" wire:model="fieldType.{{ $value }}" wire:change="checkFieldType({{ $key + 1 }}, $event.target.value)">
                                            <option value="text">Input type text</option>
                                            <option value="email">Input type email</option>
                                            <option value="password">Input type password</option>
                                            <option value="file">Input type file</option>
                                            <option value="hidden">Input type hidden</option>
                                            <option value="select">Select</option>
                                            <option value="textarea">Textarea</option>
                                        </select>
                                        @error('fieldType.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="col-sm-4 {{ $fieldTypeValues[$key + 1] != 'file' ? 'd-none' : ''  }}">
                                        <label for="filetype" class="form-label">File Types (Separated by Comma)</label>
                                        <input class="form-control" placeholder="jpeg, jpg, pdf, docx" wire:model="fileType.{{ $value }}">
                                    </div>

                                    <div class="col-sm-4 {{ $fieldTypeValues[$key + 1] != 'select' ? 'd-none' : ''  }}">
                                        <label for="selectoptions" class="form-label">Options (Separated by Comma)</label>
                                        <input class="form-control" placeholder="option1, option2, option3" wire:model="selectOptions.{{ $value }}">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="customclass" class="form-label">Custom Class</label>
                                        <input class="form-control" placeholder="class1 class2" wire:model="customClass.{{ $value }}">
                                    </div>
                                </div>
                                <div class="mb-3"></div>
                                <div class="row g-3">
                                    <h4 class="mb-3">JQuery Validation</h4>
                                    <div class="col-sm-4">
                                        <label class="form-check-label" for="minlength">Minimum Length (optional)</label>
                                        <input type="text" class="form-control" wire:model.defer="minLength.{{ $value }}">
                                        @error('minLength.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="form-check-label" for="maxlength">Maximum Length (optional)</label>
                                        <input type="text" class="form-control" wire:model.defer="maxLength.{{ $value }}">
                                        @error('maxLength.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="form-check-label" for="regex">Regex (optional)</label>
                                        <input type="text" class="form-control" wire:model.defer="regex.{{ $value }}">
                                    </div>

                                    <div class="my-3">
                                        <div class="form-check">
                                            <label class="form-check-label" for="required{{ $key + 1 }}">Required (optional)</label>
                                            <input type="checkbox" id="required{{ $key + 1 }}" class="form-check-input" wire:model.defer="required.{{ $value }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- By default one field appear --}}
                        <div class="default-field mb-3 border p-2 shadow p-3 mb-5 bg-white rounded">
                            <button class="btn btn-success border-0 rounded-circle p-2 text-white float-end" wire:click.prevent="add({{ $index }})"><i class="fa-solid fa-circle-plus"></i></button>
                            <div class="row g-3">
                                <div class="col-sm-4">
                                    <label for="label" class="form-label">Label</label>
                                    <input type="text" class="form-control" placeholder="label" wire:model.lazy="label.0">
                                    @error('label.0') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-sm-4">
                                    <label for="fieldtype" class="form-label">Field Type</label>
                                    <select class="form-select" wire:model="fieldType.0" wire:change="checkFieldType(0, $event.target.value)">
                                        <option value="text">Input type text</option>
                                        <option value="email">Input type email</option>
                                        <option value="password">Input type password</option>
                                        <option value="file">Input type file</option>
                                        <option value="hidden">Input type hidden</option>
                                        <option value="select">Select</option>
                                        <option value="textarea">Textarea</option>
                                    </select>
                                    @error('fieldType.0') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-sm-4 {{ $fieldTypeValues[0] != 'file' ? 'd-none' : ''  }}">
                                    <label for="filetype" class="form-label">File Types (Separated by Comma)</label>
                                    <input class="form-control" placeholder="jpeg, jpg, pdf, docx" wire:model.defer="fileType.0">
                                </div>

                                <div class="col-sm-4 {{ $fieldTypeValues[0] != 'select' ? 'd-none' : ''  }}">
                                    <label for="selectoptions" class="form-label">Options (Separated by Comma)</label>
                                    <input class="form-control" placeholder="option1, option2, option3" wire:model.defer="selectOptions.0">
                                </div>

                                <div class="col-sm-4">
                                    <label for="customclass" class="form-label">Custom Class</label>
                                    <input class="form-control" placeholder="class1 class2" wire:model.defer="customClass.0">
                                </div>
                            </div>
                            <div class="mb-3"></div>
                            <div class="row g-3">
                                <h4 class="mb-3">JQuery Validation</h4>
                                <div class="col-sm-4">
                                    <label class="form-check-label" for="minlength">Minimum Length (optional)</label>
                                    <input type="text" class="form-control" wire:model.defer="minLength.0">
                                    @error('minLength.0') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-sm-4">
                                    <label class="form-check-label" for="maxlength">Maximum Length (optional)</label>
                                    <input type="text" class="form-control" wire:model.defer="maxLength.0">
                                    @error('maxLength.0') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-sm-4">
                                    <label class="form-check-label" for="regex">Regex (optional)</label>
                                    <input type="text" class="form-control" wire:model.defer="regex.0">
                                </div>

                                <div class="my-3">
                                    <div class="form-check">
                                        <label class="form-check-label" for="required0">Required (optional)</label>
                                        <input type="checkbox" id="required0" class="form-check-input" wire:model.defer="required.0">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">
                    <button class="w-100 btn btn-primary btn-lg" wire:click.prevent="store()">Create</button>
                </form>
            </div>
        </div>
    </main>

    <main class="{{ $showForm ? 'd-none' : 'show' }}">
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="{{ asset('images/bootstrap-logo.svg') }}" alt="" width="72" height="57">
            <h2>Created Form</h2>
            <p class="lead">You can copy the html form and jQuery validation code.</p>
        </div>

        <div class="row g-5">
            <div class="col-md-12 col-lg-12 border shadow p-3 mb-5 bg-white rounded">
                <h4 class="mb-3">HTML Form</h4>
                {{ $form }}
            </div>

            <div class="col-md-12 col-lg-12 border shadow p-3 mb-5 bg-white rounded">
                <h4 class="mb-3">jQuery Validation</h4>
                {{ $jQueryValidation }}
            </div>
        </div>
    </main>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">© 2017–2022 Company Name</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Privacy</a></li>
            <li class="list-inline-item"><a href="#">Terms</a></li>
            <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
    </footer>
</div>