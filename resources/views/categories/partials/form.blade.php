<!-- resources/views/categories/partials/form.blade.php -->

@csrf

<div class="mb-3">
    <label for="key" class="form-label">Key</label>
    <input type="text" class="form-control @error('key') is-invalid @enderror" id="key" name="key"
        value="{{ old('key', $category->key ?? '') }}" placeholder="Enter unique key (optional)">
    @error('key')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label for="de" class="form-label">German (DE)</label>
    <input type="text" class="form-control @error('de') is-invalid @enderror" id="de" name="de"
        value="{{ old('de', $category->de ?? '') }}" placeholder="Enter German translation (optional)">
    @error('de')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label for="en" class="form-label">English (EN)</label>
    <input type="text" class="form-control @error('en') is-invalid @enderror" id="en" name="en"
        value="{{ old('en', $category->en ?? '') }}" placeholder="Enter English translation (optional)">
    @error('en')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label for="nl" class="form-label">Dutch (NL)</label>
    <input type="text" class="form-control @error('nl') is-invalid @enderror" id="nl" name="nl"
        value="{{ old('nl', $category->nl ?? '') }}" placeholder="Enter Dutch translation (optional)">
    @error('nl')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label for="fr" class="form-label">French (FR)</label>
    <input type="text" class="form-control @error('fr') is-invalid @enderror" id="fr" name="fr"
        value="{{ old('fr', $category->fr ?? '') }}" placeholder="Enter French translation (optional)">
    @error('fr')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label for="icon" class="form-label">Icon</label>
    <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon"
        value="{{ old('icon', $category->icon ?? '') }}" placeholder="Enter icon class (e.g., bx bx-category)">
    @error('icon')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
    <small class="form-text text-muted">
        Use icon classes from your chosen icon library (e.g., Boxicons).
    </small>
</div>

<div class="mb-3">
    <label for="image" class="form-label">Category Image</label>
    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
        accept="image/*">
    @error('image')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
    @isset($category->image)
        <div class="mt-2">
            <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image" class="img-thumbnail"
                width="150">
        </div>
    @endisset
</div>
