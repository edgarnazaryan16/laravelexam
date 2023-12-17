@include('layouts.header')

@include('layouts.navigation')
<main class="py-5">
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-md-8">
            <form action="{{ route('tasks.update', $task -> id) }}" method="POST">
                <div class="card">
                    <div class="card-header card-title">
                    <strong>Add New Contact</strong>
                    </div>
                    <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group row">
                            <label for="taskname" class="col-md-3 col-form-label">Task Name</label>
                            <div class="col-md-9">
                            <input type="text" name="taskname" id="taskname" class="form-control @error('taskname') is-invalid @enderror" value="{{ $task -> taskname }}">
                            @error('taskname')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="assigned_to" class="col-md-3 col-form-label @error('assigned_to') is-invalid @enderror">Assigned To</label>
                            <div class="col-md-9">
                            <select name="assigned_to" id="assigned_to" class="form-control">
                                {{-- <option value="" selected disabled>Assigned To</option> --}}
                                @foreach ($developers as $id => $developer )
                                <option value="{{ $id }}" @if ($developer === $task -> assigned_to_user -> username) selected @endif>{{ $developer }}</option>
                                @endforeach
                            </select>
                            @error('company_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-3 col-form-label">Description</label>
                            <div class="col-md-9">
                            <textarea name="description" id="description" rows="3" class="form-control  @error('description') is-invalid @enderror">{{ $task -> description }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                        </div>

                        <hr>
                        <div class="form-group row mb-0">
                            <div class="col-md-9 offset-md-3">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </main>

  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
