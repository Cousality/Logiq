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
        padding: 4px;
        background: transparent;
        border: none;
        cursor: pointer;
    }

    .search-bar button img {
        width: 50px;
        display: block;
    }
</style>

<div class="search-bar">
    <form action="{{ route('search') }}" method="GET">
        <table>
            <tr>
                <td>
                    <input type="text" name="query" placeholder="Search products..." required>
                </td>
                <td>
                    <button type="submit">
                        <img src="/Images/search_icon.png" alt="Search">
                    </button>
                </td>
            </tr>
        </table>
    </form>
</div>
