<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Address - LOGIQ</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}" />

    <style>
        .dashboard-header {
            padding: 4rem 5%;
            background: linear-gradient(135deg,
                    var(--bg-primary) 60%,
                    var(--red-pastel-1) 60%);
            border-bottom: 2px solid var(--text);
        }

        .dashboard-title {
            font-size: 4rem;
            letter-spacing: -3px;
            margin-bottom: 1rem;
        }

        .dashboard-layout {
            display: flex;
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 50px 5%;
            align-items: flex-start;
        }

        .settings-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 40px;
        }

        .settings-card {
            background: var(--white);
            border: 2px solid var(--text);
            padding: 2rem;
            box-shadow: 0px 0px 0px var(--text);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .settings-card:hover {
            transform: translate(-4px, -4px);
            box-shadow: 6px 6px 0px var(--text);
        }

        .section-title {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            border-bottom: 2px solid var(--text);
            padding-bottom: 0.5rem;
        }

        .grid-2-col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .btn-danger {
            background: var(--red-pastel-1);
            color: var(--white);
            border: 2px solid var(--red-pastel-1);
            width: 100%;
            padding: 1rem;
            font-weight: bold;
            font-size: 1.1rem;
            cursor: pointer;
            text-transform: uppercase;
            transition: transform 0.2s;
            margin-top: 0.5rem;
            font-family: inherit;
        }

        .btn-danger:hover {
            transform: translateY(-3px);
        }

        .default-badge {
            display: inline-block;
            font-size: 0.72rem;
            font-weight: bold;
            text-transform: uppercase;
            padding: 2px 8px;
            border: 2px solid var(--text);
            background: var(--text);
            color: var(--white);
            letter-spacing: 0.5px;
            margin-left: 0.75rem;
            vertical-align: middle;
        }

        @media (max-width: 768px) {
            .dashboard-title { font-size: 2.5rem; }
            .dashboard-header { background: var(--bg-primary); }
            .dashboard-layout { flex-direction: column; padding: 20px 5%; }
            .grid-2-col { grid-template-columns: 1fr; gap: 0; }
        }
    </style>
</head>

<body>
    @include('Frontend.components.nav')

    <header class="dashboard-header">
        <h1 class="dashboard-title">Your Address</h1>
        <p>Add, edit or remove your delivery addresses.</p>
    </header>

    <div class="dashboard-layout">
        @include('Frontend.components.dashboard_sidebar')
        <main class="settings-container">

            @if(session('success'))
                <div style="padding: 1rem; background: #d4edda; color: #155724; border: 2px solid #c3e6cb;">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div style="padding: 1rem; background: #f8d7da; color: #721c24; border: 2px solid #f5c6cb;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Saved addresses --}}
            @foreach($addresses as $address)
                <section class="settings-card">
                    <h2 class="section-title">
                        Saved Address
                        @if($address->isDefault)
                            <span class="default-badge">Default</span>
                        @endif
                    </h2>

                    <form id="update-{{ $address->addressID }}"
                          action="{{ route('address.update', $address->addressID) }}"
                          method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid-2-col">
                            <div class="form-group">
                                <label for="fn-{{ $address->addressID }}">First Name</label>
                                <input type="text" id="fn-{{ $address->addressID }}"
                                       name="recipientFirstName" class="form-control"
                                       value="{{ old('recipientFirstName', $address->recipientFirstName) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="ln-{{ $address->addressID }}">Last Name</label>
                                <input type="text" id="ln-{{ $address->addressID }}"
                                       name="recipientLastName" class="form-control"
                                       value="{{ old('recipientLastName', $address->recipientLastName) }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ph-{{ $address->addressID }}">Phone Number</label>
                            <input type="tel" id="ph-{{ $address->addressID }}"
                                   name="phone" class="form-control"
                                   value="{{ old('phone', $address->phone) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="al1-{{ $address->addressID }}">First Line Address</label>
                            <input type="text" id="al1-{{ $address->addressID }}"
                                   name="addressLine1" class="form-control"
                                   value="{{ old('addressLine1', $address->addressLine1) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="al2-{{ $address->addressID }}">Second Line Address</label>
                            <input type="text" id="al2-{{ $address->addressID }}"
                                   name="addressLine2" class="form-control"
                                   value="{{ old('addressLine2', $address->addressLine2) }}">
                        </div>

                        <div class="form-group">
                            <label for="ci-{{ $address->addressID }}">City</label>
                            <input type="text" id="ci-{{ $address->addressID }}"
                                   name="city" class="form-control"
                                   value="{{ old('city', $address->city) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="pc-{{ $address->addressID }}">Postcode</label>
                            <input type="text" id="pc-{{ $address->addressID }}"
                                   name="postCode" class="form-control"
                                   value="{{ old('postCode', $address->postCode) }}" required>
                        </div>
                    </form>

                    <form id="delete-{{ $address->addressID }}"
                          action="{{ route('address.destroy', $address->addressID) }}"
                          method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this address?')">
                        @csrf
                        @method('DELETE')
                    </form>

                    <button type="submit" form="update-{{ $address->addressID }}" class="btn">
                        Save Changes
                    </button>
                    <button type="submit" form="delete-{{ $address->addressID }}" class="btn-danger">
                        Delete Address
                    </button>
                </section>
            @endforeach

            {{-- Add new address --}}
            <section class="settings-card">
                <h2 class="section-title">Add New Address</h2>
                <form action="{{ route('address.store') }}" method="POST">
                    @csrf

                    <div class="grid-2-col">
                        <div class="form-group">
                            <label for="recipientFirstName">First Name</label>
                            <input type="text" id="recipientFirstName" name="recipientFirstName"
                                   class="form-control"
                                   value="{{ old('recipientFirstName', auth()->user()->firstName) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="recipientLastName">Last Name</label>
                            <input type="text" id="recipientLastName" name="recipientLastName"
                                   class="form-control"
                                   value="{{ old('recipientLastName', auth()->user()->lastName) }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" class="form-control"
                               value="{{ old('phone') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="addressLine1">First Line Address</label>
                        <input type="text" id="addressLine1" name="addressLine1" class="form-control"
                               value="{{ old('addressLine1') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="addressLine2">Second Line Address</label>
                        <input type="text" id="addressLine2" name="addressLine2" class="form-control"
                               value="{{ old('addressLine2') }}">
                    </div>

                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" id="city" name="city" class="form-control"
                               value="{{ old('city') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="postCode">Postcode</label>
                        <input type="text" id="postCode" name="postCode" class="form-control"
                               value="{{ old('postCode') }}" required>
                    </div>

                    <button type="submit" class="btn">Save Changes</button>
                </form>
            </section>

        </main>
    </div>

    @include('Frontend.components.footer')
</body>

</html>
