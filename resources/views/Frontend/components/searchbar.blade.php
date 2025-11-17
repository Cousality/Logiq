<style>
    .search-bar {
        display: flex;
        align-items: center;
    }

    .search-bar form {
        display: flex;
        align-items: center;
    }

    .search-bar input {
        padding: 8px;
        width: 400px;
        font-size: 15px;
        border: none;
        border-radius: 8px 0 0 8px;
        outline: none;
    }

    .search-bar button {
        padding: 8px;
        background: white;
        border: none;
        border-radius: 0 8px 8px 0;
        cursor: pointer;
        display: flex;
        align-items: center;
    }

    .search-bar button img {
        width: 30px;
        height: 30px;
    }
</style>

<div class="search-bar">
    <form action="{{ route('search') }}" method="GET">
        <input type="text" name="query" placeholder="Search..." required>
        <button type="submit">
            <img src="Images/search_icon.png" alt="Search">
        </button>
    </form>
</div>
