<style>
    .search-bar {
        display: flex;
        align-items: center;
        width: 100%;
        justify-content: center;
    }

    .search-bar form {
        display: flex;
        align-items: stretch;
        border-radius: 8px;
        overflow: hidden;
        border: 2px solid rgba(0, 0, 0, 0.3);
    }

    .search-bar input {
        padding: 8px 15px;
        width: 100%;
        font-size: 15px;
        border: none;
        background: white;
        outline: none;
        flex: 1;
    }

    .search-bar button {
        padding: 8px 15px;
        background-color: #310E0E !important;
        border: none !important;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0;
        box-shadow: none !important;
        flex-shrink: 0;
    }

    .search-bar button:hover {
        background-color: #4A1F1F !important;
    }

    .search-bar button img {
        width: 20px;
        height: 20px;
        display: block;
    }
</style>

<div class="search-bar">
    <form action="{{ route('search') }}" method="GET">
        <input type="text" name="query" placeholder="Search..." required>
        <button type="submit">
            <img src="{{ asset('Images/search_icon.png') }}" alt="Search">
        </button>
    </form>
</div>

</form>
</div>
