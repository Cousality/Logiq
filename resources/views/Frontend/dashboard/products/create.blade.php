<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - LOGIQ Admin</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}" />
    <style>
        .dashboard-header {
            padding: 4rem 5%;
            background: linear-gradient(135deg, var(--bg-primary) 60%, var(--red-pastel-1) 60%);
            border-bottom: 2px solid var(--text);
        }

        .dashboard-title {
            font-size: 4rem;
            letter-spacing: -3px;
            margin-bottom: 1rem;
        }

        .management-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 50px 5%;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .settings-card {
            background: var(--white);
            border: 2px solid var(--text);
            padding: 2.5rem;
        }

        .section-title {
            font-size: 1.8rem;
            margin-bottom: 2rem;
            text-transform: uppercase;
            border-bottom: 2px solid var(--text);
            padding-bottom: 0.5rem;
        }

        .back-nav { margin-bottom: 10px; }

        .btn-secondary {
            background: transparent;
            color: var(--text);
            padding: 10px 15px;
            text-decoration: none;
            border: 2px solid var(--text);
            display: inline-block;
            font-weight: bold;
            transition: 0.2s;
        }

        .btn-secondary:hover {
            background: var(--text);
            color: var(--white);
            transform: translateY(-2px);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            background: var(--bg-primary);
            border: 1px solid var(--text);
            color: var(--text);
            font-family: inherit;
            font-size: 1rem;
            transition: 0.2s;
        }

        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--red-pastel-1);
            background: var(--white);
            box-shadow: 4px 4px 0px rgba(0,0,0,0.1);
        }

        .form-group textarea { resize: vertical; min-height: 120px; }

        .form-group input[type="file"] {
            padding: 8px;
            font-size: 0.9rem;
        }

        .image-hint {
            font-size: 0.8rem;
            opacity: 0.7;
            margin-top: 0.25rem;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
            align-items: center;
        }

        @media (max-width: 600px) {
            .dashboard-title { font-size: 2.5rem; }
            .dashboard-header { background: var(--bg-primary); }
            .form-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    @include('Frontend.components.nav')

    <header class="dashboard-header">
        <h1 class="dashboard-title">Add Product</h1>
        <p>Create a new product listing.</p>
    </header>

    <main class="management-container">
        <div class="back-nav">
            <a href="{{ route('admin.products.index') }}" class="btn-secondary">&larr; Back to Inventory</a>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="settings-card">
            <h2 class="section-title">Product Details</h2>

            <form action="{{ route('admin.products.store') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  novalidate
                  id="productForm">
                @csrf

                {{-- Name --}}
                <div class="form-group">
                    <label for="productName">Product Name *</label>
                    <input type="text"
                           id="productName"
                           name="productName"
                           value="{{ old('productName') }}"
                           required
                           maxlength="255"
                           placeholder="e.g. Classic Wooden Jigsaw">
                    @error('productName')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Slug --}}
                <div class="form-group">
                    <label for="productSlug">URL Slug</label>
                    <input type="text"
                           id="productSlug"
                           name="productSlug"
                           value="{{ old('productSlug', old('productName') ? \Illuminate\Support\Str::slug(old('productName')) : '') }}"
                           maxlength="255"
                           placeholder="leave blank to auto-generate from name">
                    @error('productSlug')
                        <span class="error">{{ $message }}</span>
                    @enderror
                    <p class="image-hint">Used in the product URL. Auto-filled from the name — edit to customise.</p>
                </div>

                {{-- Category & Difficulty --}}
                <div class="form-row">
                    <div class="form-group">
                        <label for="productCategory">Category *</label>
                        <select id="productCategory" name="productCategory" required>
                            <option value="" disabled {{ old('productCategory') ? '' : 'selected' }}>— Select —</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ old('productCategory') === $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        </select>
                        @error('productCategory')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="productDifficulty">Difficulty *</label>
                        <select id="productDifficulty" name="productDifficulty" required>
                            <option value="" disabled {{ old('productDifficulty') ? '' : 'selected' }}>— Select —</option>
                            @foreach($difficulties as $diff)
                                <option value="{{ $diff }}" {{ old('productDifficulty') === $diff ? 'selected' : '' }}>
                                    {{ ucfirst($diff) }}
                                </option>
                            @endforeach
                        </select>
                        @error('productDifficulty')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Price & Quantity --}}
                <div class="form-row">
                    <div class="form-group">
                        <label for="productPrice">Price (£) *</label>
                        <input type="number"
                               id="productPrice"
                               name="productPrice"
                               value="{{ old('productPrice') }}"
                               required
                               min="0"
                               step="0.01"
                               placeholder="0.00">
                        @error('productPrice')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="productQuantity">Stock Quantity *</label>
                        <input type="number"
                               id="productQuantity"
                               name="productQuantity"
                               value="{{ old('productQuantity', 0) }}"
                               required
                               min="0"
                               step="1">
                        @error('productQuantity')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Status --}}
                <div class="form-group">
                    <label for="productStatus">Status *</label>
                    <select id="productStatus" name="productStatus" required>
                        @foreach($statuses as $status)
                            <option value="{{ $status }}" {{ old('productStatus', 'active') === $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                    @error('productStatus')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="form-group">
                    <label for="productDescription">Description</label>
                    <textarea id="productDescription"
                              name="productDescription"
                              placeholder="Describe the product...">{{ old('productDescription') }}</textarea>
                    @error('productDescription')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Image --}}
                <div class="form-group">
                    <label for="productImage">Product Image</label>
                    <input type="file"
                           id="productImage"
                           name="productImage"
                           accept="image/jpeg,image/png,image/webp">
                    <p class="image-hint">JPG, PNG or WebP · max 2 MB</p>
                    @error('productImage')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn">Create Product</button>
                    <a href="{{ route('admin.products.index') }}" class="btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </main>

    @include('Frontend.components.footer')

    <script>
        (function () {
            function toSlug(str) {
                return str.toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .trim()
                    .replace(/[\s-]+/g, '-');
            }
            var nameInput = document.getElementById('productName');
            var slugInput = document.getElementById('productSlug');
            var slugEdited = slugInput.value.length > 0;
            slugInput.addEventListener('input', function () { slugEdited = true; });
            nameInput.addEventListener('input', function () {
                if (!slugEdited) slugInput.value = toSlug(this.value);
            });
        })();

        document.getElementById('productForm').addEventListener('submit', function (e) {
            let valid = true;
            const errors = [];

            const name = document.getElementById('productName');
            if (!name.value.trim()) { errors.push('Product name is required.'); valid = false; }

            const category = document.getElementById('productCategory');
            if (!category.value) { errors.push('Category is required.'); valid = false; }

            const difficulty = document.getElementById('productDifficulty');
            if (!difficulty.value) { errors.push('Difficulty is required.'); valid = false; }

            const price = document.getElementById('productPrice');
            if (price.value === '' || parseFloat(price.value) < 0) {
                errors.push('Price must be 0 or greater.'); valid = false;
            }

            const qty = document.getElementById('productQuantity');
            if (qty.value === '' || parseInt(qty.value) < 0) {
                errors.push('Quantity must be 0 or greater.'); valid = false;
            }

            const img = document.getElementById('productImage');
            if (img.files.length > 0) {
                const allowed = ['image/jpeg', 'image/png', 'image/webp'];
                if (!allowed.includes(img.files[0].type)) {
                    errors.push('Image must be JPG, PNG, or WebP.'); valid = false;
                }
                if (img.files[0].size > 2 * 1024 * 1024) {
                    errors.push('Image must be under 2 MB.'); valid = false;
                }
            }

            if (!valid) {
                e.preventDefault();
                alert('Please fix the following:\n\n' + errors.join('\n'));
            }
        });
    </script>
</body>
</html>
