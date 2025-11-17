<style>
    .search-bar {
        display: flex;
        align-items: center;
    }

    .search-bar input {
        padding: 8px;
        width: 300px;
        font-size: 14px;
        border: 1px solid white;
        border-radius: 4px;
    }

    .search-bar button {
        padding: 8px;
        background: transparent;
        border: none;
        cursor: pointer;
    }

    .search-bar button img {
        width: 30px;
    }
</style>

<div class="search-bar">
    <form action="{{ route('search') }}" method="GET">
        <input type="text" name="query" placeholder="Search products..." required>
        <button type="submit">
            <img src="Images/search_icon.png" alt="Search">
        </button>
    </form>
</div>
