@include('layouts.header')

@include('layouts.navigation')

<main class="py-5">
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-md-8">
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header card-title">
                    <strong>Add New Task</strong>
                    </div>
                    <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group row">
                            <label for="taskname" class="col-md-3 col-form-label">Task Name</label>
                            <div class="col-md-9">
                            <input type="text" name="taskname" id="taskname" value="{{ old('taskname') }}" class="form-control @error('taskname') is-invalid @enderror">
                            @error('taskname')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="assigned_to" class="col-md-3 col-form-label">Developer</label>
                            <div class="col-md-9">
                                <select name="assigned_to" id="assigned_to" class="form-control @error('assigned_to') is-invalid @enderror">
                                    <option value="" selected disabled>Select Developer</option>
                                    @foreach ($developers as $id => $developer )
                                    <option value="{{ $id }}">{{ $developer }}</option>
                                    @endforeach
                                </select>
                            @error('assigned_to')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-3 col-form-label">Description</label>
                            <div class="col-md-9">
                            <textarea name="description" id="description" rows="3" value="{{ old('description') }}" class="form-control @error('description') is-invalid @enderror"></textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                        </div>

                        <hr>
                        <div class="form-group row mb-0">
                            <div class="col-md-9 offset-md-3">
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
