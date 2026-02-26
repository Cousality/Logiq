<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Promotion - LOGIQ Admin</title>
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

        .form-group select {
            width: 100%;
            padding: 12px;
            background: var(--bg-primary);
            border: 1px solid var(--text);
            color: var(--text);
            font-family: inherit;
            font-size: 1rem;
            transition: 0.2s;
        }

        .form-group select:focus {
            outline: none;
            border-color: var(--red-pastel-1);
            background: var(--white);
            box-shadow: 4px 4px 0px rgba(0,0,0,0.1);
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
            align-items: center;
        }

        .field-hint {
            font-size: 0.8rem;
            opacity: 0.7;
            margin-top: 0.25rem;
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
        <h1 class="dashboard-title">Edit Promotion</h1>
        <p>Update the details for <strong>{{ $promotion->promotionCode }}</strong>.</p>
    </header>

    <main class="management-container">
        <div class="back-nav">
            <a href="{{ route('admin.promotions.index') }}" class="btn-secondary">&larr; Back to Promotions</a>
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
            <h2 class="section-title">Promotion Details</h2>

            <form action="{{ route('admin.promotions.update', $promotion->promotionID) }}"
                  method="POST"
                  novalidate
                  id="promoForm">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="promotionCode">Promotion Code *</label>
                    <input type="text"
                           id="promotionCode"
                           name="promotionCode"
                           value="{{ old('promotionCode', $promotion->promotionCode) }}"
                           required
                           maxlength="50"
                           style="text-transform:uppercase;">
                    @error('promotionCode')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="discountType">Discount Type *</label>
                        <select id="discountType" name="discountType" required>
                            <option value="percentage" {{ old('discountType', $promotion->discountType) === 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                            <option value="fixed"      {{ old('discountType', $promotion->discountType) === 'fixed'      ? 'selected' : '' }}>Fixed (£)</option>
                        </select>
                        @error('discountType')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="discountValue">Discount Value *</label>
                        <input type="number"
                               id="discountValue"
                               name="discountValue"
                               value="{{ old('discountValue', $promotion->discountValue) }}"
                               required
                               min="0"
                               step="0.01">
                        <p class="field-hint" id="valueHint"></p>
                        @error('discountValue')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn">Save Changes</button>
                    <a href="{{ route('admin.promotions.index') }}" class="btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </main>

    @include('Frontend.components.footer')

    <script>
        (function () {
            var typeSelect = document.getElementById('discountType');
            var valueInput = document.getElementById('discountValue');
            var valueHint  = document.getElementById('valueHint');

            function updateHint() {
                if (typeSelect.value === 'percentage') {
                    valueHint.textContent = 'Enter a value between 0 and 100.';
                    valueInput.max = '100';
                } else {
                    valueHint.textContent = 'Enter the fixed amount in pounds.';
                    valueInput.removeAttribute('max');
                }
            }

            typeSelect.addEventListener('change', updateHint);
            updateHint();
        })();
    </script>
</body>
</html>
