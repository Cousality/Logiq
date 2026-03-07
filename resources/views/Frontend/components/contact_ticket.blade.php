<style>
    .ticket-card {
        background: var(--bg-secondary);
        padding: 20px;
        margin-bottom: 20px;
        border: 2px solid var(--text);
    }

    .ticket-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid var(--text);
    }

    .ticket-info {
        display: flex;
        gap: 15px;
        align-items: center;
        flex-wrap: wrap;
    }

    .ticket-number {
        font-weight: bold;
        font-size: 18px;
        color: var(--text);
    }

    .ticket-category {
        padding: 4px 12px;
        font-size: 13px;
        font-weight: bold;
        text-transform: uppercase;
        border: 1px solid currentColor;
    }

    .category-delivery { color: #1976d2; border-color: #1976d2; }
    .category-refund   { color: #f57c00; border-color: #f57c00; }
    .category-account  { color: #7b1fa2; border-color: #7b1fa2; }
    .category-payment  { color: #c62828; border-color: #c62828; }
    .category-other    { color: #424242; border-color: #424242; }

    .ticket-date {
        color: var(--text);
        font-size: 13px;
        opacity: 0.6;
    }

    .ticket-customer {
        margin-bottom: 12px;
        font-size: 14px;
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
    }

    .customer-badge {
        padding: 3px 10px;
        font-size: 0.72rem;
        font-weight: bold;
        text-transform: uppercase;
        border: 1px solid currentColor;
    }

    .badge-registered { color: #4a7c59; border-color: #4a7c59; }
    .badge-guest      { color: #888;    border-color: #888; }

    .ticket-description {
        margin-bottom: 15px;
        line-height: 1.6;
    }

    .ticket-description p {
        margin: 0 0 6px 0;
        color: var(--text);
    }

    .ticket-actions {
        display: flex;
        gap: 10px;
    }

    .btn-resolve {
        padding: 8px 16px;
        border: none;
        cursor: pointer;
        font-size: 14px;
        font-family: inherit;
        font-weight: bold;
        transition: all 0.2s;
        background: var(--red-pastel-1);
        color: var(--white);
    }

    .btn-resolve:hover {
        transform: translateY(-2px);
        opacity: 0.9;
    }
</style>

<div class="ticket-card">
    <div class="ticket-header">
        <div class="ticket-info">
            <span class="ticket-number">#{{ $ticket->supportNum }}</span>
            <span class="ticket-category category-{{ strtolower($ticket->problemCategory) }}">
                {{ $ticket->problemCategory }}
            </span>
        </div>
        <span class="ticket-date">{{ \Carbon\Carbon::parse($ticket->created_at)->format('d M Y, H:i') }}</span>
    </div>

    <div class="ticket-customer">
        <strong>{{ $ticket->firstName ? $ticket->firstName . ' ' . $ticket->lastName : ($ticket->name ?? 'Guest') }}</strong>
        <span style="opacity:0.6;">{{ $ticket->userEmail ?? $ticket->email ?? 'No email provided' }}</span>
        @if($ticket->userID)
            <span class="customer-badge badge-registered">Registered Customer</span>
        @else
            <span class="customer-badge badge-guest">Guest</span>
        @endif
    </div>

    @if(isset($ticket->orderNumber) && $ticket->orderNumber)
        <div style="margin-bottom: 10px; font-size: 14px;">
            <strong>Order #:</strong> {{ $ticket->orderNumber }}
        </div>
    @endif

    <div class="ticket-description">
        <p>{{ $ticket->problemDescription }}</p>
    </div>

    <div class="ticket-actions">
        <button class="btn-resolve" onclick="resolveTicket({{ $ticket->supportNum }})">Resolve</button>
    </div>
</div>
