<div>
    <!-- Navbar -->
    <!-- You can insert your Navbar code here if needed -->
   
    <!-- Main Container -->
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col">
            </div>
        </div>
        
        @if (session()->has('message'))
            <div class="alert alert-success mt-3">
                {!! session('message') !!}
            </div>
        @endif

        <!-- Form -->
        <form wire:submit.prevent="submit" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label text-primary">Title</label>
                <input type="text" class="form-control" id="title" wire:model.defer="title" required>
                @error('title') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label text-primary">Description</label>
                <textarea class="form-control" id="description" wire:model.defer="description"></textarea>
                @error('description') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="due_date" class="form-label text-primary">Due Date</label>
                <input type="date" class="form-control" id="due_date" wire:model.defer="due_date">
                @error('due_date') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label text-primary">Image</label>
                <input type="file" class="form-control" id="image" wire:model="image">
                @error('image') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <!-- Image Preview -->
            @if ($image)
                <div class="mb-3">
                    <label class="form-label text-primary">Image Preview</label>
                    <img src="{{ $image->temporaryUrl() }}" alt="Image Preview" class="img-fluid mt-2" style="max-width: 200px;">
                </div>
            @endif

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="completed" wire:model.defer="completed">
                <label class="form-check-label" for="completed">Completed</label>
            </div>

            <div class="d-grid gap-2">
                <!-- Add Task button with soft pastel green color -->
                <button type="submit" class="btn" style="background-color:rgb(102, 201, 165); color: #fff; border-radius: 25px; padding: 12px 24px;">Add Task</button>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS and optional Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
