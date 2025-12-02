<style>
    .ticket-card {
        background: white;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        border-left: 4px solid rgba(49, 14, 14, 1);
    }

    .ticket-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #e0e0e0;
    }

    .ticket-info {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .ticket-number {
        font-weight: bold;
        font-size: 18px;
        color: rgba(49, 14, 14, 1);
    }

    .ticket-category {
        padding: 5px 12px;
        border-radius: 15px;
        font-size: 13px;
        font-weight: 500;
    }

    .category-delivery {
        background: #e3f2fd;
        color: #1976d2;
    }

    .category-refund {
        background: #fff3e0;
        color: #f57c00;
    }

    .category-account {
        background: #f3e5f5;
        color: #7b1fa2;
    }

    .category-payment {
        background: #ffebee;
        color: #c62828;
    }

    .category-other {
        background: #e0e0e0;
        color: #424242;
    }

    .ticket-date {
        color: #666;
        font-size: 14px;
    }

    .ticket-user {
        margin-bottom: 15px;
        font-size: 15px;
        color: #333;
    }

    .ticket-email {
        color: #666;
        font-size: 14px;
    }

    .ticket-description {
        margin-bottom: 15px;
    }

    .ticket-description strong {
        display: block;
        margin-bottom: 8px;
        color: rgba(49, 14, 14, 1);
    }

    .ticket-description p {
        margin: 0;
        color: #555;
        line-height: 1.6;
        white-space: pre-wrap;
    }

    .ticket-actions {
        display: flex;
        gap: 10px;
    }

    .btn-view,
    .btn-resolve {
        padding: 8px 16px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.3s;
    }

    .btn-view {
        background: rgba(49, 14, 14, 1);
        color: white;
    }

    .btn-view:hover {
        background: rgba(49, 14, 14, 0.9);
    }

    .btn-resolve {
        background: #4caf50;
        color: white;
    }

    .btn-resolve:hover {
        background: #45a049;
    }
</style>


<div class="ticket-card">
    <div class="ticket-description">
        <p>{{ $ticket->problemDescription }}</p>
    </div>

    <div class="ticket-actions">
        <button class="btn-resolve" onclick="resolveTicket({{ $ticket->supportNum }})">Resolve</button>
    </div>
</div>
